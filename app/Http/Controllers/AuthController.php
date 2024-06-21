<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Muestra la vista de registro
    public function register()
    {
        return view('register');
    }

    // Maneja el envío del formulario de registro
    public function registerPost(Request $request)
    {
        $user = new User();

        // Asigna los valores del formulario al nuevo usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hashea la contraseña antes de guardarla
        $user->rol = $request->rol;
        $user->save(); // Guarda el nuevo usuario en la base de datos

        // Redirige al usuario a la vista de login con un mensaje de éxito
        back()->with('success', 'Register successfully');
        return view('login');
    }

    // Muestra la vista de login
    public function login()
    {
        return view('login');
    }

    // Maneja el envío del formulario de login
    public function loginPost(Request $request)
    {
        // Credenciales del usuario extraídas del formulario
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Intenta autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            // Obtiene el usuario autenticado
            $user = Auth::user();

            // Redirige al usuario a la página correspondiente según su rol
            switch ($user->rol) {
                case 1:
                    return redirect('/homeAdmin')->with('success', 'Login Success');
                    break;

                case 2:
                    return redirect('/homeAlumno')->with('success', 'Login Success');
                    break;
            }
        }

        // Si la autenticación falla, redirige de vuelta al formulario de login con un mensaje de error
        return back()->with('error', 'Error Email or Password');
    }

    // Maneja el cierre de sesión del usuario
    public function logout()
    {
        Auth::logout(); // Cierra la sesión del usuario

        // Redirige al usuario a la vista de login
        return redirect()->route('login');
    }
}
