<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('settings')->get();
        $ibadah = DB::table('ibadah')->orderBy('nama')->get();
        return view('home',['data'=>$data, 'ibadah'=>$ibadah]);
    }

    public function settings()
    {
        $data = DB::table('ibadah')->orderBy('nama')->get();
        return view('settings',['data'=>$data]);
    }

    public function submit_ibadah( Request $request ) {
        $id = $request->input('id');
        $active_service = $request->input('active_service');

        DB::table('settings')->where('id',$id)->update(
                                                    [
                                                     'value' => $active_service
                                                    ] );
        return redirect('admin/')->with('success','Berhasil melakukan edit ibadah aktif!');
    }
}
