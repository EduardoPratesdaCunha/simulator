<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 text-gray-800">
      {{-- @dd(Session::get('message')) --}}
      <form action="{{ route('simulate.index') }}" method="GET">
        @csrf
        <div class="min-h-screen flex items-center justify-center">
          <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold mb-6 text-center">Simulador de Juros Compostos</h1>
            <div>
              <label for="initial_value" class="block text-sm font-medium text-gray-700">Valor Inicial (R$)</label>
              <input type="number"
                name="initial_value"
                id="initial_value"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                required
                value="{{ isset($request['initial_value']) ? $request['initial_value'] : 0 }}">
            </div>
            <div>
              <label for="value_per_month" class="block text-sm font-medium text-gray-700">Valor adicional por Mês (R$)</label>
              <input type="number"
                name="value_per_month"
                id="value_per_month"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                required
                value="{{ isset($request['value_per_month']) ? $request['value_per_month'] : 0 }}">
            </div>
            <div>
              <label for="rate" class="block text-sm font-medium text-gray-700">Taxa de Juros Anual (%)</label>
              <input type="number"
                name="rate"
                id="rate"
                step="0.01"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                required
                value="{{ isset($request['rate']) ? $request['rate'] : 0 }}">
            </div>
            <div>
              <label for="months" class="block text-sm font-medium text-gray-700">Número de Períodos (Anos)</label>
              <input type="number"
                name="months"
                id="months"
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                required
                value="{{ isset($request['months']) ? $request['months'] : 0 }}">
            </div>
            <div class="text-center">
              <button type="submit" class="bg-blue-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-blue-600 ">Calcular</button>
            </div>
            <label for="result" class="block text-sm font-medium">Resultado:</label>
            <input class="mt-1 block w-full p-2 border border-gray-300 rounded-md" type="text" name="result" value="{{ $result ?? 0 }}" disabled>
          </div>
        </div>
      </form>

        {{-- <script>
            function calculate() {
                const principal = parseFloat(document.getElementById('principal').value);
                const rate = parseFloat(document.getElementById('rate').value) / 100;
                const years = parseInt(document.getElementById('years').value);

                const amount = principal * Math.pow((1 + rate), years);
                document.getElementById('result').innerText = `Valor Futuro: R$ ${amount.toFixed(2)}`;
            }
        </script> --}}
    </body>
</html>
