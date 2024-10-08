@extends('layouts.layout')

@section('content')
  <section>
    <div class="min-h-screen flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Registrar-se</h1>
        <form id="resetPasswordForm" action="{{ route('auth.register.store') }}" method="POST">
          @method('POST')
          @csrf
          <div class="my-6">
            <label for="name" class="block text-sm font-medium text-gray-700">Nome:</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
          </div>
          <div class="my-6">
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail:</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
          </div>
          <div class="my-6">
            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" maxlength="14" />
          </div>
          <div class="my-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
          </div>
          <div class="my-6">
            <label for="password_confirm" class="block text-sm font-medium text-gray-700">Confirmar Senha:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
          </div>
          <div class="flex items-center justify-around">
            <div class="flex justify-around">
              <button type="submit" class="bg-blue-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-blue-600">Enviar</button>
            </div>
            <div class="flex items-center justify-center">
              <a href="{{ route('home') }}" class="text-black font-bold my-6 py-2 px-4 rounded">Voltar</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script>
    document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
      var password = document.getElementById('password').value;
      var passwordConfirm = document.getElementById('password_confirmation').value;

      if (password !== passwordConfirm) {
        event.preventDefault();
        alert('As senhas não coincidem.');
      }
    });
  </script>
@endsection

