@extends('layouts.layout')

@section('content')
  <section>
    <div class="min-h-screen flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Faça Login</h1>
        <form action="{{ route('auth.login') }}" method="POST">
          @method('POST')
          @csrf
          <div class="my-6">
            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
          </div>
          <div class="flex items-center justify-around">
            <div class="flex justify-around">
              <button type="submit" class="bg-blue-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-blue-600">Logar</button>
            </div>
            <div class="flex items-center justify-center">
              <a href="{{ route('auth.register') }}" class="text-black font-bold my-6 py-2 px-4 rounded">Registra-se</a>
            </div>
          </div>
        </form>
        <a href="{{ route('auth.password') }}" class="items-center text-blue-500 flex justify-center">
          Esqueci a senha
        </a>
      </div>
    </div>
  </section>
@endsection

