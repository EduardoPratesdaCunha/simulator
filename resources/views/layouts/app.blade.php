<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Calcule Juros Composto</title>
    </head>
    <body class=" dark:bg-gray-800">
      <nav class="bg-gray-900">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
          <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
              <div class="hidden sm:ml-6 sm:block">
                <div class="flex space-x-4">
                  <a href="{{ route('simulate.index') }}" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-medium text-white" aria-current="page">Lista de Simulados</a>
                  <a href="{{ route('simulate.create') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Criar novo</a>
                </div>
              </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
              <div class="relative ml-3">
                <a href=""></a>
                <form action="{{ route('auth.logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="bg-blue-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-blue-600">Logout</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <main class="max-w-md mt-4 absolute top-8 right-5">
        @if ($errors->any())
          <div role="alert">
            <ul class="list-inside text-sm">
              @foreach ($errors->all() as $error)
                <li class="error-message bg-red-100 border text-red-700 px-3 py-2 rounded relative my-4 font-normal">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if (session('success'))
          <div role="alert">
            <ul class="list-inside text-sm">
              <li class="error-message bg-red-100 border text-green-700 px-3 py-2 rounded relative my-4 font-normal">{{ session('success') }}</li>
            </ul>
          </div>
        @endif
      </main>

      @yield('content')

      <script>
        document.addEventListener('DOMContentLoaded', (event) => {
          const errorMessages = document.querySelectorAll('.error-message');

          errorMessages.forEach(message => {
            setTimeout(() => {
              message.style.transition = 'opacity 0.6s ease-out';
              message.style.opacity = 0;
              setTimeout(() => {
                message.style.display = 'none';
              }, 600);
            }, 5000);
          });
        });
      </script>
    </body>
</html>