@extends('layouts.layout')

@section('content')
<section>
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
@endsection
