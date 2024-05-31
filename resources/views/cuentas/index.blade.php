@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Lista de Cuentas</h1>
            <a href="{{ url('cuentas/create') }}" class="btn btn-primary">Agregar Cuenta</a>
            <br><br>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Monto</th>
                        <th>Saldo</th>
                        <th>Fecha de Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuentas as $cuenta)
                        <tr>
                            <td>{{ $cuenta->id }}</td>
                            <td>{{ $cuenta->user->name }}</td>
                            <td>{{ $cuenta->amount }}</td>
                            <td>{{ $cuenta->balance }}</td>
                            <td>{{ $cuenta->payment_date }}</td>
                            <td>
                                <a href="{{ url('cuentas/'.$cuenta->id.'/edit') }}" class="btn btn-warning">Editar</a>
                                <form action="{{ url('cuentas/'.$cuenta->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
