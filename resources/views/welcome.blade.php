<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-500 text-gray-800">
      <header class="flex justify-around bg-orange-300 py-10">
        <h1>Titulo</h1>
        <div>
          <a href="#">Faça login</a>
          <a href="#">Registra-se</a>
        </div>
      </header>
      <section class="flex justify-between align-center w-3/4 m-auto">
      <form action="{{ route('simulate.index') }}" method="GET">
        @csrf
        <div class="min-h-screen flex items-center justify-center">
          <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Simulador de Juros Compostos</h1>
            <div>
              <label for="initial_value" class="block text-sm font-medium text-gray-700">Valor Inicial (R$)</label>
              <input type="text"
                name="initial_value"
                id="initial_value"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                value="{{ isset($request['initial_value']) ? $request['initial_value'] : '' }}">
            </div>
            <div>
              <label for="value_per_month" class="block text-sm font-medium text-gray-700">Valor adicional por Mês (R$)</label>
              <input type="text"
                name="value_per_month"
                id="value_per_month"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                value="{{ isset($request['value_per_month']) ? $request['value_per_month'] : '' }}">
            </div>
            <div>
              <label for="rate" class="block text-sm font-medium text-gray-700">Taxa de Juros Anual (%)</label>
              <input type="text"
                name="rate"
                id="rate"
                step="0.01"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                value="{{ isset($request['rate']) ? $request['rate'] : '' }}">
            </div>
            <div>
              <label for="months" class="block text-sm font-medium text-gray-700">Número de Períodos (Anos)</label>
              <input type="text"
                name="months"
                id="months"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                value="{{ isset($request['months']) ? $request['months'] : '' }}">
            </div>
            <div class="flex justify-around">
              <button type="submit" class="bg-blue-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-blue-600 ">Calcular</button>
              <a href="{{ url('/') }}" class="bg-gray-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-gray-600">Limpar</a>
            </div>
            <label for="result" class="block text-sm font-medium">Resultado:</label>
            <input class="mt-1 block w-full p-2 border border-gray-300 rounded-md" type="text" name="result" value="{{ $result ?? 0 }}" disabled>
          </div>
        </div>
      </form>
    </section>
    <main class="max-w-md mt-4 absolute top-5 right-5">
      @if ($errors->any())
        <div role="alert">
          <ul class="list-inside text-sm">
            @foreach ($errors->all() as $error)
              <li class="error-message bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative my-4">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </main>
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
