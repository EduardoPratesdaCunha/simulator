
<div class="min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">{{ $title }}</h1>
    @if (Auth::check())
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
        <input type="text"
          name="name"
          id="name"
          class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
          value="{{ $simulate->name ?? null }}">
      </div>
    @endif
    <div>
      <label for="initial_value" class="block text-sm font-medium text-gray-700">Valor Inicial (R$)</label>
      <input type="text"
        name="initial_value"
        id="initial_value"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        value="{{ isset($request['initial_value']) ? $request['initial_value'] : ( $simulate->initial_value ?? null) }}">
    </div>
    <div>
      <label for="value_per_month" class="block text-sm font-medium text-gray-700">Valor adicional por Mês (R$)</label>
      <input type="text"
        name="value_per_month"
        id="value_per_month"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        value="{{ isset($request['value_per_month']) ? $request['value_per_month'] : ( $simulate->value_per_month ?? null) }}">
    </div>
    <div>
      <label for="rate" class="block text-sm font-medium text-gray-700">Taxa de Juros Anual (%)</label>
      <input type="text"
        name="rate"
        id="rate"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        value="{{ isset($request['rate']) ? $request['rate'] : ( $simulate->rate ?? null) }}">
    </div>
    <div>
      <label for="months" class="block text-sm font-medium text-gray-700">Número de Períodos (Anos)</label>
      <input type="text"
        name="months"
        id="months"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
        value="{{ isset($request['months']) ? $request['months'] : ( $simulate->months ?? null) }}">
    </div>
    <div class="flex justify-around">
      <button type="submit" class="bg-blue-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-blue-600">Calcular</button>
      @if (Auth::check())
        <a href="{{ route('simulate.index') }}" class="bg-gray-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-gray-600">Voltar</a>
      @else
        <a href="{{ url('/') }}" class="bg-gray-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-gray-600">Limpar</a>
      @endif
    </div>
    @if(!Auth::check())
      <label for="result" class="block text-sm font-medium">Resultado:</label>
      <input class="mt-1 block w-full p-2 border border-gray-300 rounded-md" type="text" name="result" value="{{ $result ?? 0 }}" disabled>
    @endif
  </div>
</div>
