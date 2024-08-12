<?php

use App\Http\Controllers\SimulateController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  return view('welcome');
});

Route::get('/simulate', [SimulateController::class, 'index'])->name('simulate.index');
Route::post('/simulate', [SimulateController::class, 'store'])->name('simulate.store');
