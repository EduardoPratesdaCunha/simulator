@extends('layouts.app')

@section('content')
  <section>
      <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Lista De simulados</h1>
            </div>
            <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
                <form class="flex items-center justify-between" action="{{ route('simulate.index') }}" method="GET">
                  <div class="m-4">
                    <label class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400" for="name">
                      Pesquise o nome
                    </label>
                    <input type="text"
                      name="name"
                      class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                      value="{{ !empty(request()->name) ? request()->name : '' }}">
                  </div>
                  <div class="m-4">
                    <label class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400" for="created_at">
                      Data de criação
                    </label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                      type="date"
                      name="created_at"
                      value="{{ !empty(request()->created_at) ? \Carbon\Carbon::parse(request()->created_at)->format('Y-m-d') : '' }}">
                  </div>
                  <div class="mt-4">
                    <button class="px-5 py-1 mx-1 border-b-4 border-transparent hover:border-gray-500 rounded text-xs font-medium text-gray-500 uppercase dark:text-gray-400 transition duration-300" type="submit">
                      Filtrar
                    </button>
                    <a class="px-5 py-1 mx-1 border-b-4 border-transparent hover:border-gray-500 rounded text-xs font-medium text-gray-500 uppercase dark:text-gray-400 transition duration-300" href="{{ route('simulate.index') }}">
                      Limpar
                    </a>
                  </div>
                </form>
                <a href="{{ route('simulate.create') }}"
                  class=" px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700 transition duration-300">
                  Adicionar
                </a>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full min-h-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                          <tr>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Nome
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Capital inicial
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Valor mensal
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Valor de rendimento
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Tempo Ano | Mês
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Valor Total
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Taxa ao Ano | ao Mês
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Data de criação
                              </th>
                              <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Ações
                              </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                          <tr class="dark:bg-gray-900 text-white hover:bg-black-100 dark:bg-black-800 dark:hover:bg-black-200 dark:divide-black-700">
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                              Valor Total
                            </td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                              {{ valueFormat($simulates->sum('initial_value')) }}
                            </td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                              {{ valueFormat($simulates->sum('value_per_month')) . " | " . valueFormat($simulates->sum('value_per_month') * 12) }}
                            </td>
                            <td></td>
                            <td></td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                              {{ valueFormat($simulates->sum('result') - ($simulates->sum('initial_value') + ($simulates->sum('value_per_month') * 12))) }}
                            </td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                              {{ valueFormat($simulates->sum('result')) }}
                            </td>
                            <td></td>
                            <td></td>
                          </tr>
                          @foreach ($simulates as $simulate)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                  <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $simulate->name }}</div>
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ valueFormat($simulate->initial_value) }}</div>
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ valueFormat($simulate->value_per_month) . " | " . valueFormat($simulate->value_per_month * 12) }}</div>
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $simulate->rate }}% | {{ rateFormat(($simulate->rate / 100) / 12) }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ intval($simulate->months) / 12 }} ano(s) | {{ $simulate->months }} Mêses</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ valueFormat($simulate->result - ($simulate->initial_value + ($simulate->value_per_month * 12)))  }}</td>
                                <td class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">{{ valueFormat($simulate->result) }}</td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $simulate->created_at->format('d/m/Y') }}</td>

                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('simulate.edit', ['id' => $simulate->id]) }}" type="button"  data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                        Editar
                                    </a>
                                    <form action="{{ route('simulate.destroy', ['id' => $simulate->id]) }}" method="post">
                                      @method('DELETE')
                                      @csrf
                                      <button type="sumbit" id="deleteProductButton" data-drawer-target="drawer-delete-product-default" data-drawer-show="drawer-delete-product-default" aria-controls="drawer-delete-product-default" data-drawer-placement="right" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                          <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                          Excluir
                                      </button>
                                    </form>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection