<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerificarEdadUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware(['auth'])->group(function () {
    Route::get('/completar-perfil', [PerfilController::class, 'form'])->name('perfil.form');
    Route::post('/completar-perfil', [PerfilController::class, 'guardar'])->name('perfil.guardar');
});

Route::view('/acceso-denegado', 'grupos.denegado')->middleware('auth');

Route::middleware([VerificarEdadUsuario::class])->group(function () {

    Route::get('/redirigir', fn() => redirect()->route('dashboard'))->name('redirigir');


    Route::get('/dashboard', fn() => view('dashboard.index'))->name('dashboard');


    Route::view('/bebes', 'grupos.bebes');
    Route::view('/ninos', 'grupos.ninos');
    Route::view('/adolescentes', 'grupos.adolescentes');
    Route::view('/jovenes', 'grupos.jovenes');
    Route::view('/adultos', 'grupos.adultos');
    Route::view('/mayores', 'grupos.mayores');
    Route::view('/longevos', 'grupos.longevos');


    Route::view('/menor-de-16', 'edad.menor');
    Route::view('/entre-16-y-17', 'edad.entre16y17');
    Route::view('/mayor-de-edad', 'edad.mayor');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/user', [UserController::class, 'index'])->name('user');
});

Route::get('/ingresar-edad', function () {
    return view('edad.ingresar');
})->name('ingresar.edad');


Route::post('/ingresar-edad', function (Request $request) {
    $request->validate([
        'edad' => ['required', 'integer', 'min:0', 'max:120'],
    ]);

    if (Auth::check()) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    session(['visitante_edad' => $request->input('edad')]);

    return redirect()->route('redirigir');
})->name('guardar.edad');
