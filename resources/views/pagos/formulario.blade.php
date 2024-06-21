@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Realizar Pago</h1>
        <p>Por favor, introduce el monto del pago para la cuenta {{ $cuenta }}</p>
        <form action="{{ route('realizarPago', $cuenta) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="monto" class="form-label">Monto del Pago</label>
                <input type="number" class="form-control" id="cuenta_id" name="cuenta_id" value="{{ $cuenta }}" hidden>
                <input type="number" class="form-control" id="monto" name="monto" value="0" required>
            </div>
            <button type="submit" class="btn btn-primary">Realizar Pago</button>
        </form>
    </div>
@endsection
