<!-- resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Lista de Usuarios</h1>

    <a href="{{ url('users/create') }}" class="btn btn-primary">Crear Usuario</a>

    <br><br>

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <br>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->rol == 2 ? 'Usuario' : 'Administrador' }}</td>
                    <td>
                        <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-primary">Editar</a>
                        <form action="{{ url('users/' . $user->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
