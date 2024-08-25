<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SimulateController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthTokenProtected;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/login', [AuthenticateController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthenticateController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthenticateController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthenticateController::class, 'store'])->name('auth.register.store');

Route::get('/password', [AuthenticateController::class, 'resetpassword'])->name('auth.password');
Route::post('/password', [AuthenticateController::class, 'password'])->name('auth.password.store');
Route::get('/password/reset/{token}', [AuthenticateController::class, 'passwordEdit'])->name('auth.password.edit');
Route::put('/password/reset', [AuthenticateController::class, 'passwordUpdate'])->name('auth.password.update');

Route::post('/simulate/store', [SimulateController::class, 'store'])->name('simulate.store');


Route::middleware(AuthTokenProtected::class)->group(function () {
  Route::post('/logout', [AuthenticateController::class, 'logout'])->name('auth.logout');

  Route::prefix('simulate')->group(function () {
    Route::get('/index', [SimulateController::class, 'index'])->name('simulate.index');
    Route::get('/create', [SimulateController::class, 'create'])->name('simulate.create');
    Route::get('/edit/{id}', [SimulateController::class, 'edit'])->name('simulate.edit');
    Route::PATCH('/update/{id}', [SimulateController::class, 'update'])->name('simulate.update');
    Route::delete('/delete/{id}', [SimulateController::class, 'destroy'])->name('simulate.destroy');
  });

});