<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $validator =  $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->route('test.blade');
        }
        $validator['emailPassword'] = 'Email address or password is incorrect.';

        return redirect("login")->withErrors($validator);
    }



    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'FullName' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);



        $user = User::create([
            'name' => $request->input('name'),
            'FullName' => $request->input('FullName'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
        Auth::login($user);

        return redirect()->route('main');
    }




    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
