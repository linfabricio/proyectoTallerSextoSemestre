<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use App\Models\Pago;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentasController extends Controller
{
    // Muestra una lista de todas las cuentas
    public function index()
    {
        $cuentas = Cuenta::with('user')->get(); // Obtiene todas las cuentas con la información del usuario asociado
        return view('cuentas.index', compact('cuentas')); // Retorna la vista con las cuentas obtenidas
    }

    // Muestra el formulario para crear una nueva cuenta
    public function create()
    {
        $users = User::where('rol', '<>', 1)->get(); // Obtiene todos los usuarios que no son administradores
        return view('cuentas.create', compact('users')); // Retorna la vista con los usuarios obtenidos
    }

    // Maneja el envío del formulario para crear una nueva cuenta
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id', // user_id debe existir en la tabla de usuarios
            'amount' => 'required|numeric', // amount debe ser numérico
            'balance' => 'required|numeric', // balance debe ser numérico
            'payment_date' => 'required|date_format:Y-m-d', // payment_date debe tener el formato de fecha Y-m-d
        ]);

        // Crea una nueva cuenta con los datos validados
        Cuenta::create($request->all());

        // Redirige a la lista de cuentas con un mensaje de éxito
        return redirect('/cuentas')->with('success', 'Cuenta creada correctamente.');
    }

    // Muestra el formulario para editar una cuenta existente
    public function edit($id)
    {
        $cuenta = Cuenta::findOrFail($id); // Busca la cuenta por su ID, o lanza un error si no la encuentra
        $users = User::all(); // Obtiene todos los usuarios
        return view('cuentas.edit', compact('cuenta', 'users')); // Retorna la vista con la cuenta y los usuarios obtenidos
    }

    // Maneja el envío del formulario para actualizar una cuenta existente
    public function update(Request $request, $id)
    {
        // Valida los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id', // user_id debe existir en la tabla de usuarios
            'amount' => 'required|numeric', // amount debe ser numérico
            'balance' => 'required|numeric', // balance debe ser numérico
            'payment_date' => 'required|date_format:Y-m-d', // payment_date debe tener el formato de fecha Y-m-d
        ]);

        $cuenta = Cuenta::findOrFail($id); // Busca la cuenta por su ID, o lanza un error si no la encuentra
        $cuenta->update($request->all()); // Actualiza la cuenta con los datos validados

        // Redirige a la lista de cuentas con un mensaje de éxito
        return redirect('/cuentas')->with('success', 'Cuenta actualizada correctamente.');
    }

    // Maneja la eliminación de una cuenta existente
    public function destroy($id)
    {
        $cuenta = Cuenta::findOrFail($id); // Busca la cuenta por su ID, o lanza un error si no la encuentra
        $cuenta->delete(); // Elimina la cuenta

        // Redirige a la lista de cuentas con un mensaje de éxito
        return redirect('/cuentas')->with('success', 'Cuenta eliminada correctamente.');
    }

    public function showPendingAccounts()
    {
        $user = Auth::user();
        $cuentasPendientes = $user->cuentas()->where('balance', '>', '0')->get();

        return view('alumno.cuentasPendientes', compact('cuentasPendientes'));
    }

    public function mostrarFormularioPago($cuenta)
    {
        return view('pagos.formulario', compact('cuenta'));
    }

    public function realizarPago(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'cuenta_id' => 'required',
            'monto' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo pago
        $pago = new Pago();
        $pago->cuenta_id = $request->cuenta_id;
        $pago->monto = $request->monto;
        $pago->save();

        $cuenta = Cuenta::where('id', $request->cuenta_id)->first();
        $cuenta->balance -= $pago->monto;
        $cuenta->save();

        // Redirigir o devolver una respuesta
        return redirect()->route('alumno.pending_accounts')->with('success', 'Pago realizado correctamente');
    }
}
