<?php

use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SimulateController;
use App\Http\Middleware\AuthTokenProtected;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  return view('welcome');
});

Route::get('/login', [AuthenticateController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthenticateController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthenticateController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthenticateController::class, 'store'])->name('auth.register.store');

Route::get('/simulate', [SimulateController::class, 'index'])->name('simulate.index');
Route::post('/simulate', [SimulateController::class, 'store'])->name('simulate.store');

Route::middleware(AuthTokenProtected::class)->group(function () {
  Route::post('/logout', [AuthenticateController::class, 'logout'])->name('auth.logout');

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});