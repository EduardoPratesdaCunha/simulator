<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
  public function index()
  {
    return view('auth.login');
  }
  public function register()
  {
    return view('auth.register');
  }

  public function login(LoginRequest $request)
  {
    try {
      $data = $request->validated();

      if (Auth::attempt(['cpf' => $data['cpf'], 'password' => $data['password']])) {
        return redirect()->route('dashboard');
      };

      return redirect()->route('login');

    } catch (\Exception $e) {
      return back()->withErrors(['error' => 'Credencias Invalidas']);
    }

  }

  public function logout()
  {
    Auth::logout();
    return redirect('/login');
  }
}
