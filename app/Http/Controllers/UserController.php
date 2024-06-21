<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Muestra una lista de todos los usuarios
    public function index()
    {
        $users = User::all(); // Obtiene todos los usuarios
        return view('administrarUsers', compact('users')); // Retorna la vista con los usuarios obtenidos
    }

    // Muestra el formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create'); // Retorna la vista para crear un nuevo usuario
    }

    // Maneja el envío del formulario para crear un nuevo usuario
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255', // name es requerido, debe ser una cadena y tener un máximo de 255 caracteres
            'email' => 'required|email|unique:users,email', // email es requerido, debe ser un email válido y único en la tabla de usuarios
            'password' => 'required|string|min:8', // password es requerido, debe ser una cadena y tener un mínimo de 8 caracteres
            'rol' => 'required|integer', // rol es requerido y debe ser un entero
        ]);

        // Crea un nuevo usuario con los datos validados
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hashea la contraseña antes de guardarla
        $user->rol = $request->rol;
        $user->save(); // Guarda el nuevo usuario en la base de datos

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect('/users')->with('success', 'Usuario creado correctamente.');
    }

    // Muestra el formulario para editar un usuario existente
    public function edit($id)
    {
        $user = User::find($id); // Busca el usuario por su ID
        return view('users.edit', compact('user')); // Retorna la vista con el usuario encontrado
    }

    // Maneja el envío del formulario para actualizar un usuario existente
    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255', // name es requerido, debe ser una cadena y tener un máximo de 255 caracteres
            'email' => 'required|email|unique:users,email,' . $id, // email es requerido, debe ser un email válido y único en la tabla de usuarios excepto el actual
            'rol' => 'required|integer', // rol es requerido y debe ser un entero
        ]);

        $user = User::findOrFail($id); // Busca el usuario por su ID, o lanza un error si no lo encuentra

        // Actualiza los datos del usuario con los datos validados
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rol = $request->rol;
        $user->save(); // Guarda los cambios en la base de datos

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect('/users')->with('success', 'Usuario actualizado correctamente.');
    }

    // Maneja la eliminación de un usuario existente
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Busca el usuario por su ID, o lanza un error si no lo encuentra
        $user->delete(); // Elimina el usuario

        // Redirige a la lista de usuarios con un mensaje de éxito
        return redirect('/users')->with('success', 'Usuario eliminado correctamente.');
    }
}
