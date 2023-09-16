<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function halamanlogin()
    {
        return view('Template.Login.Login-aplikasi');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        return redirect()->route('login')->with('error', 'Email atau password salah.');

        // if (Auth::attempt($request->only('email', 'password'))) {

        //     return redirect('/home')->with('success', 'Welcome Back');
        // }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function registrasi()
    {
        return view('Template.Login.registrasi');
    }

    public function simpanregistrasi(Request $request)
    {
        //dd($request->all());
        User::create([
            'name' => $request->name,
            'level' => 'dosen',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60)
        ]);

        // return view('welcome');
        return redirect('/login');
    }
}
