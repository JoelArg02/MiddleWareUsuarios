<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerificarEdadUsuario;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Rutas para completar perfil
Route::middleware(['auth'])->group(function () {
    Route::get('/completar-perfil', [PerfilController::class, 'form'])->name('perfil.form');
    Route::post('/completar-perfil', [PerfilController::class, 'guardar'])->name('perfil.guardar');
});

// Rutas según edad del usuario
Route::middleware(['auth'])->group(function () {
    Route::view('/menor-de-16', 'edad.menor');
    Route::view('/entre-16-y-17', 'edad.entre16y17');
    Route::view('/mayor-de-edad', 'edad.mayor');
});

Route::middleware(['auth', VerificarEdadUsuario::class])->get('/redirigir', function () {
    // No hace falta lógica aquí, el middleware se encarga de redirigir
    return redirect()->route('dashboard');
})->name('redirigir');

// Rutas protegidas con auth y verificación de edad
Route::middleware(['auth', VerificarEdadUsuario::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});

// Rutas protegidas solo con auth
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/user', [UserController::class, 'index'])->name('user');
});
