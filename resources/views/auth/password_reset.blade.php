@extends('layouts.layout')

@section('content')
  <section>
    <div class="min-h-screen flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Digite sua nova senha</h1>
        <form id="resetPasswordForm" action="{{ route('auth.password.update') }}" method="POST">
          @method('PUT')
          @csrf
          <input type="hidden" name="email" value="{{ request('email') }}">
          <div class="my-6">
            <label for="password" class="block text-sm font-medium text-gray-700">Senha:</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
          </div>
          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha:</label>
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

