<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/homeAdmin', [HomeController::class, 'indexAdmin']);
    Route::get('/homeAlumno', [HomeController::class, 'indexAlumno']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/alumno/cuentas-pendientes', [CuentasController::class, 'showPendingAccounts'])->name('alumno.pending_accounts');
    Route::match(['get', 'post'], '/mostrar/{id?}', [CuentasController::class, 'mostrarFormularioPago'])->name('mostrarPago');
    Route::match(['get', 'post'],'/realizar/{id?}', [CuentasController::class, 'realizarPago'])->name('realizarPago');

    Route::resource('cuentas', CuentasController::class);
});
