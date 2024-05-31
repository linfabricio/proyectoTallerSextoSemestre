<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->rol = $request->rol;
        $user->save();

        back()->with('success', 'Register successfully');
        return view('login');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) {

            $user = Auth::user();

            switch ($user->rol) {
                case 1:
                    return redirect('/homeAdmin')->with('success', 'Login Success');
                    break;

                case 2:
                    return redirect('/homeAlumno')->with('success', 'Login Success');
                    break;
            }
        }

        return back()->with('error', 'Error Email or Password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
