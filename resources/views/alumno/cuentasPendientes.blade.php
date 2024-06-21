@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cuentas Pendientes</h1>
        @if ($cuentasPendientes->isEmpty())
            <p>No tienes cuentas pendientes.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Monto</th>
                        <th>Saldo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cuentasPendientes as $cuenta)
                        <tr>
                            <td>{{ $cuenta->id }}</td>
                            <td>{{ $cuenta->payment_date }}</td>
                            <td>{{ $cuenta->amount }}</td>
                            <td>{{ $cuenta->balance }}</td>
                            <td>
                                <form action="{{ route('mostrarPago', $cuenta->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Realizar Pago</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
