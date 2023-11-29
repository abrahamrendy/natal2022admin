<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DNS2D;
use Storage;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ibadah_asal = DB::table('ibadah_asal')->get();
        // $ibadah = DB::table('ibadah')->get();
        $ibadah = DB::select('SELECT id, nama, qty, IFNULL(t.ct, 0) as ct FROM ibadah LEFT OUTER JOIN (SELECT ibadah, count(id) as ct FROM `registrant` GROUP BY ibadah) as t ON ibadah.id = t.ibadah');
        return view('index',['ibadah_asal'=>$ibadah_asal, 'ibadah'=>$ibadah]);
    }

    public function verificator()
    {
        $active_service = DB::table('settings')->join('ibadah', 'settings.value', '=', 'ibadah.id')->first();
        $total_activated = DB::table('registrant')->where('ibadah', $active_service->value)->where('attend', 1)->count();
        // $data = DB::table('registrant')->join('ibadah', 'registrant.ibadah', '=', 'ibadah.id')->select('registrant.id as registrant_id', 'registrant.nama as registrant_name', 'registrant.*', 'ibadah.*')->orderBy('registrant.id', 'desc')->where('ibadah', $active_service->value)->get();
        $data = DB::table('registrant')->orderBy('registrant.updated_at', 'desc')->where('ibadah', $active_service->value)->get();
        return view('verificator',['data'=>$data, 'total_activated' => $total_activated, 'active_service'=> $active_service]);
    }

    public function scan (Request $request) {
        $active_service = DB::table('settings')->first();
        $registration_code = strip_tags($request->input('registration_code'));
        $create_date = date('Y-m-d H:i:s' , strtotime('now + 7 hours'));

        $isExist = DB::table('registrant')->where('qr_code',$registration_code)->where('ibadah', $active_service->value)->where('attend',0)->first();

        if ($isExist) {
            if ($isExist->attend == 0) {
                DB::table('registrant')->where('id',$isExist->id)->update(
                                                                            [
                                                                             'attend' => '1',
                                                                             'updated_at' => $create_date
                                                                            ] );
                \Session::flash('success', $registration_code . ' berhasil diverifikasi!');
                return back();
            } else {
                \Session::flash('fail', $registration_code .  ' telah diverifikasi pada ', $create_date);
                return back();
            }
        } else {
            $temp = DB::table('registrant')->join('ibadah', 'registrant.ibadah', '=', 'ibadah.id')->select('registrant.id as registrant_id', 'registrant.nama as registrant_name', 'registrant.*', 'ibadah.*')->orderBy('registrant.id', 'desc')->where('qr_code',$registration_code)->get();
            $msg = '';
            $type = '';
            if (!$temp->isEmpty()) {
                foreach ($temp as $value) {
                    if (($value->ibadah == $active_service->value) && $value->attend == 1){
                        $type = 'fail';
                        $msg = "<br>".$registration_code . ' telah diverifikasi sebelumnya pada: ' . $value->updated_at."<br>";
                        // dd($type);
                    } else {
                        $type = 'wrong';
                        $msg .= "<br>Nama: ".$value->registrant_name."<br>";
                        $msg .= "Tempat Ibadah: ".$value->nama;
                    }
                }
                \Session::flash($type, $msg);
            } else {
                \Session::flash('fail', 'QR Code tidak terdaftar!');
            }
            // else {
            //     if (is_numeric($registration_code)) {
            //         $id = DB::table('registrant')->insertGetId(
            //                                         ['kaj' => '000',
            //                                          'nama' => 'anom',
            //                                          'email' => 'anom',
            //                                          'phone' => '0000',
            //                                          'dob' => $create_date,
            //                                          'm-class' => '0',
            //                                          'ibadah_asal' => '0',
            //                                          'qr_code' => $registration_code,
            //                                          'ibadah' => $active_service->value,
            //                                          'created_at' => $create_date,
            //                                          'attend' => '1',
            //                                         ] );
            //         if ($id) {
            //             \Session::flash('success', 'QR Code '.$registration_code.' terdaftar!');
            //             return back();
            //         } else {
            //             \Session::flash('fail', 'QR Code '.$registration_code.' tidak terdaftar!');
            //             return back();
            //         }
            //     }
            //     \Session::flash('fail', 'QR Code tidak terdaftar!');
            // }
            return back();
        }
    }

    public function submit(Request $request) {
        $kaj = $request->input('kaj');
        $nama = $request->input('nama');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $dob = date('Y-m-d', strtotime($request->input('dob')));
        $m_class = $request->input('mclass');
        $ibadah_asal = $request->input('ibadah_asal');
        $ibadah = $request->input('ibadah');
        $created_at = date('Y-m-d H:i:s', strtotime('now + 7 hours'));

        $getService = DB::table('ibadah')->where('id', $ibadah)->first();

        $countUser = DB::table('registrant')->where('ibadah',$ibadah)->count();

        $existedUser = DB::table('registrant')->join('ibadah', 'registrant.ibadah', '=', 'ibadah.id')->where('registrant.nama', $nama)->where('registrant.dob', $dob)->select('registrant.id as registrant_id', 'registrant.nama as registrant_name', 'ibadah.*')->first();

        if (!empty($existedUser)) {
            return view('fail', ['code' => 0, 'data' => $getService]);
        }

        if ($countUser >= ($getService->qty)) {
            // USER EXCEEDED CAPACITY
            return view('fail', ['code' => 1, 'data' => $getService]);
        } else {
            $id = DB::table('registrant')->insertGetId(
                                                ['kaj' => $kaj,
                                                 'nama' => $nama,
                                                 'email' => $email,
                                                 'phone' => $phone,
                                                 'dob' => $dob,
                                                 'm-class' => $m_class,
                                                 'ibadah_asal' => $ibadah_asal,
                                                 'ibadah' => $ibadah,
                                                 'created_at' => $created_at,
                                                ] );
            if ($id) {

                if ($kaj != '') {
                    $combine = $kaj;
                } else {
                    $ibadahAsal = DB::table('ibadah_asal')->where('id', $ibadah_asal)->first();
                    $counterUp = $ibadahAsal->counter + 1;
                    $combine = date('Y', strtotime('now + 7 hours')).$ibadah_asal.$counterUp;
                    DB::table('ibadah_asal')->where('id',$ibadah_asal)->update(
                                                                        [
                                                                         'counter' => $counterUp
                                                                        ] );
                }
                
                DB::table('registrant')->where('id',$id)->update(
                                                                        [
                                                                         'qr_code' => $combine
                                                                        ] );
                Storage::disk('public')->put('qrcodes/'.$combine.'.jpg',base64_decode(DNS2D::getBarcodePNG($combine, "QRCODE", 10,10)));
                // SET UP EMAIL
                // $this->registEmail($email, $getService, $id, $combine);
                return view('success', ['data' => $getService, 'id' => $id, 'name' => $nama, 'code' => $combine]);
            } else {
                // GENERIC ERROR MESSAGE
                return view('fail', ['code' => 0, 'data' => $getService]);
            }

        }
    }

    public function registEmail ($to, $ibadah, $id, $code) {
        $subject = 'GBI Sukawarna Christmas Celebration Service Confirmation';
        $htmlBody = '<table width=700px style="background-color:#07121E; padding:40px 40px">';
        $htmlBody .= '<tr>
                        <td> 
                            <table width=100% style="background-color: #1d252f; padding:20px 20px;font-family: sans-serif;color: #fff !important"> 
                                <tr>
                                    <td>
                                        <br>
                                        <tr> 
                                            <td> 
                                                <div style="display: inline-block;width: 100%; text-align: center"> 
                                                    <img src="https://i.imgur.com/eb3pyoN.png" width="50%"> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td align="center"> 
                                                <br><br><p> 
                                                <h1 style="word-break: break-word;color: #fff !important">No.urut: '.$id.'</h1> 
                                                <h1 style="word-break: break-word;color: #fff !important">Terima Kasih, '.$name.'</h1>
                                                <h3 style="word-break: break-word; font-weight: normal;color: #fff !important">Anda telah terdaftar untuk mengikuti ibadah natal GBI Sukawarna.</h3>
                                                <h1 style="word-break: break-word;color: #fff !important">'.$ibadah->nama.'</h1>
                                                <h3 style="word-break: break-word; font-weight: normal; font-style: italic;color: #fff !important">Informasi: +'.$ibadah->contact_person.'</h3> 
                                                <hr>
                                                <img src="'.asset("img/qrcodes/".$code.".jpg").'"></img>
                                                <h3 style="word-break: break-word; font-weight: normal;color: #fff !important">Mohon membawa QR-Code ini saat daftar ulang sehingga tim kami dapat mengkonfirmasi kehadiran anda.</h3> 
                                                </p>
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td align="center"> 
                                                <hr> <br>
                                                <p style="font-weight: bold"> <i>Tuhan Yesus Memberkati.</i></p><br>
                                            </td>
                                        </tr>
                                    <tr><td><br>';

        // Headers
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: GBI Sukawarna <gbisukawarna@gbisukawarna.org>';
        //End of send email//
        return mail($to, $subject, $htmlBody, implode("\r\n", $headers));
    }
}
