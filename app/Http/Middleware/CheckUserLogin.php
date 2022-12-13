<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('user')) {
            return $next($request);
        } else {
            $email = $request->email;
            $password = $request->password;
            $dob = date("Y-m-d", strtotime($password));

            $getUser = DB::table('registrant')->where('email', $email)->where('dob',$dob)->first();

            if (!empty($getUser)) {
                $request->session()->put('currUser',$getUser);
                $request->session()->put('user',$email);
                return $next($request);
            } else {
                return redirect('/')->with('fail','Email/Password salah.');
            }
        }
        // return $next($request);
        return redirect('/')->with('fail','Akses ditolak! Mohon log in.');
    }
}
