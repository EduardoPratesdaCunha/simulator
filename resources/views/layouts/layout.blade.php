<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>

    </head>
    <body class="bg-gray-500 text-gray-800">
      <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
          <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
              <!-- Mobile menu button-->
              <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Open main menu</span>
                <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

                <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
              <div class="hidden sm:ml-6 sm:block">
                <div class="flex space-x-4">
                  <a href="{{ route('home') }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">
                    Inicio
                  </a>
                </div>
              </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
              <a href="{{ route('auth.login') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                Login
              </a>
              <a href="{{ route('auth.register') }}" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
                Registra-se
              </a>
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

        document.addEventListener('DOMContentLoaded', function() {
          const cpfInput = document.getElementById('cpf');

          cpfInput.addEventListener('input', function(event) {
            let value = cpfInput.value.replace(/\D/g, '');

            if (value.length > 11) {
              value = value.substring(0, 11);
            }
            if (value.length <= 11) {
              value = value.replace(/^(\d{3})(\d{0,3})(\d{0,3})(\d{0,2}).*$/, '$1.$2.$3-$4');
            }

            cpfInput.value = value;
          });
        });
      </script>
    </body>
</html>