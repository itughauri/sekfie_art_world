<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class signupController extends Controller
{

    public function login()
    {
        return view('login.login');
    }

    public function check(Request $request)
    {

       $credentials = $request->only('email', 'password');
       if(Auth::attempt($credentials)){
        return redirect('/');
       }else{
        return back()->with('error','You cannnot logged in');
       }

}

public function logout() {
    Auth::logout();
    return redirect('/auth/login');
}

}
