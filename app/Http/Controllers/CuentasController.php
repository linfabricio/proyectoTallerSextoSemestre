<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\User;
use Illuminate\Http\Request;

class CuentasController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::with('user')->get();
        return view('cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        $users = User::where('rol', '<>', 1)->get();
        return view('cuentas.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'balance' => 'required|numeric',
            'payment_date' => 'required|date_format:Y-m-d',
        ]);

        Cuenta::create($request->all());

        return redirect('/cuentas')->with('success', 'Cuenta creada correctamente.');
    }


    public function edit($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $users = User::all();
        return view('cuentas.edit', compact('cuenta', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'balance' => 'required|numeric',
            'payment_date' => 'required|date_format:Y-m-d',
        ]);

        $cuenta = Cuenta::findOrFail($id);
        $cuenta->update($request->all());

        return redirect('/cuentas')->with('success', 'Cuenta actualizada correctamente.');
    }


    public function destroy($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $cuenta->delete();

        return redirect('/cuentas')->with('success', 'Cuenta eliminada correctamente.');
    }
}
