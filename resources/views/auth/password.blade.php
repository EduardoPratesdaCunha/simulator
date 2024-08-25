@extends('layouts.layout')

@section('content')
  <section>
    <div class="min-h-screen flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Recupere sua Conta</h1>
        <form action="{{ route('auth.password.store') }}" method="POST">
          @method('POST')
          @csrf
          <div class="my-6">
            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
          </div>
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail:</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
          </div>
          <div class="flex items-center justify-around">
            <button type="submit" class="bg-blue-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-blue-600">Enviar</button>
          </div>
        </form>
        <div class="flex items-center justify-center">
          <a href="{{ route('auth.register') }}" class="text-black font-bold my-6 py-2 px-4 rounded">Voltar</a>
        </div>
    </div>
  </section>
@endsection

