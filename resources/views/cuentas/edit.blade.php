@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Editar Cuenta</h2>
            <form method="POST" action="{{ url('cuentas/'.$cuenta->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="user_id">Usuario:</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">Seleccionar Usuario</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $cuenta->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Monto:</label>
                    <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="{{ $cuenta->amount }}" required>
                </div>

                <div class="form-group">
                    <label for="balance">Saldo:</label>
                    <input type="number" step="0.01" name="balance" id="balance" class="form-control" value="{{ $cuenta->balance }}" required>
                </div>

                <div class="form-group">
                    <label for="payment_date">Fecha y Hora de Pago:</label>
                    <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($cuenta->payment_date)) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Cuenta</button>
                <a href="{{ url('cuentas') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
