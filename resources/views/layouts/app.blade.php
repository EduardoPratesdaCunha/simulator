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
        <h1>Dashboard</h1>
        <form action="{{ route('auth.logout') }}" method="POST">
          @csrf
          <button type="submit" class="bg-green-500 text-white font-bold my-6 py-2 px-4 rounded hover:bg-green-600">Logout</button>
        </form>
      </header>
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
      </script>
    </body>
</html>