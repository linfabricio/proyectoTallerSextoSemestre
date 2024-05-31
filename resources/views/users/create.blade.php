<!-- resources/views/users/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Agregar Nuevo Usuario</h2>
            <form method="POST" action="{{ url('users') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <div>
                        <input type="radio" id="rol1" name="rol" class="form-check-input"
                            value="1">
                        <label for="rol1" class="form-check-label">Administrador</label>
                    </div>
                    <div>
                        <input type="radio" id="rol2" name="rol" class="form-check-input"
                            value="2">
                        <label for="rol2" class="form-check-label">Alumno</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                <a href="{{ url('users') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
