<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function logout() {
        Auth::logout();
        session()->flush(); // delete semua session
        return redirect('/login');
    }

    //show login form
    function login() {
        return view('login.form');
    }

    // authentication
    function auth(Request $req) {
        // baca data dari form
        $email = $req->email;
        $password = $req->password;

        // compare data dgn db (users table)
        // first() - return 1 rekod shj vs get() - return semua data
        // OR return null jika tiada data
        $usr = User::where('email', $email)->first();
        if ($usr) {
            // user wujud, check password
            if (Hash::check($password, $usr->password)) {
                // password matched. Daftar ke dlm laravel
                session(['name' => 'John Doe']); // create session
                Auth::login($usr);
                return redirect('/post-dashboard');
            } else{
                // password x matched
                $err = 'password does not matched!';
                return view('login.form', compact('err'));
            }
        } else {
            // email x wujud
            $err = 'Email does not exist!';
            return view('login.form', compact('err'));
        }
    }
}
