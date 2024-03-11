<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        // dd(auth()->user());
        if(auth()->guard('admin')->user()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::where('email',$request->email)->where('status','active')->first();

        if(!$user)
            return redirect()->back()->withErrors([__('auth.email_not_found')]);
            
        if($user->password_type=='md5' && $user->password != md5(md5($request->password)))
            return redirect()->back()->withErrors([__('auth.password_incorrect')]);
            
        if($user->password_type!='md5' && !Hash::check($request->password, $user->password))
            return redirect()->back()->withErrors([__('auth.password_incorrect')]);
            
        auth()->guard('admin')->login($user, $request->remember_me);
        // $request->session()->regenerate();
        // return redirect()->intended('admin');
        return redirect()->route('admin.dashboard');

    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    public function requestForgotPassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user)
            return redirect()->back()->withErrors([__('auth.email_not_found')]);

        $user->reset_password_token = sha1(Str::random(30));
        $user->save();

        Mail::to($user)->send(new ResetPasswordMail($user));

        return redirect()->back()->with('success',__('auth.please_check_your_email_to_reset_password'));
    }

    public function getResetPassword($token)
    {
        $user = User::where('reset_password_token',$token)->firstOrFail();
        return view('admin.auth.reset-password',['token'=>$token]);
    }

    public function postResetPassword(Request $request)
    {
        $request->validate([
            'reset_password_token'=>'required|exists:users',
            'password'=>'required|min:8|confirmed'
        ]);

        $user = User::where('reset_password_token',$request->reset_password_token)->first();

        $user->password = Hash::make($request->password);
        $user->password_type = 'bcrypt';
        $user->reset_password_token = null;
        $user->reset_password_at=Carbon::now();
        $user->save();

        return redirect()->route('admin.login')->with('success',__('auth.password_has_been_reset_successfully'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
