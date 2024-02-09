<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        if(auth()->check()) return redirect()->route('dashboard');

        return view('auth.login');
    }

    public function resetPassword()
    {
        if(auth()->check()) auth()->logout();

        return view('auth.reset-password');
    }

    public function resetPasswordToken(Request $request)
    {
        if(auth()->check()) auth()->logout();
        
        return view('auth.reset-password-token', [
            'request' => $request,
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('auth.login');
    }

    public function register()
    {
        if(auth()->check()) return redirect()->route('dashboard');

        return view('auth.register');
    }
}
