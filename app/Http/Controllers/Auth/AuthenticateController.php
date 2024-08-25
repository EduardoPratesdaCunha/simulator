<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        return redirect()->route('simulate.index');
      };

      return redirect()->route('login');

    } catch (\Exception $e) {
      return back()->withErrors(['error' => 'Credencias Invalidas']);
    }

  }

  public function store(RegisterRequest $request)
  {
    try {
      $data = $request->validated();

      User::create($data);

      return redirect()->route('auth.login');

    } catch (\Exception $e) {
      Log::error($e->getMessage(), $e);
      return back()->withErrors(['error' => 'Algo deu errado']);
    }
  }

  public function resetpassword()
  {
    return view('auth.password');
  }

  public function password(PasswordRequest $request)
  {
    $data = $request->validated();
    $token = Str::random(60);

    Mail::to($data['email'])->send(new PasswordResetMail($data['email'], $token));

    return back()->with('success', 'Um e-mail de redefinição de senha foi enviado.');
  }

  public function passwordEdit($token)
  {
    return view('auth.password_reset', ['token' => $token]);
  }

  public function passwordUpdate(PasswordResetRequest $request)
  {
    try {
      DB::beginTransaction();
      $data = $request->validated();

      User::where('email', $data['email'])->first()->update(['password' => Hash::make($data['password'])]);

      DB::commit();
      return redirect('/login');

    } catch (\Exception $e) {
      DB::rollBack();
      Log::error($e);
      return back()->withErrors('Erro ao atualizar senha');
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/login');
  }
}
