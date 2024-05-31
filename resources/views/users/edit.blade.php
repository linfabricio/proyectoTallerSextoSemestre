<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Editar Usuario</h2>
            <form method="POST" action="{{ url('users/'.$user->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <div>
                        <input type="radio" id="rol1" name="rol" class="form-check-input" value="1" {{ $user->rol == 1 ? 'checked' : '' }}>
                        <label for="rol1" class="form-check-label">Administrador</label>
                    </div>
                    <div>
                        <input type="radio" id="rol2" name="rol" class="form-check-input" value="2" {{ $user->rol == 2 ? 'checked' : '' }}>
                        <label for="rol2" class="form-check-label">Alumno</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                <a href="{{ url('users') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
