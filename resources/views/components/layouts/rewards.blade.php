<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>{{ config('app.name') }}</title>

   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
   <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
   @vite(['resources/css/rewards.css', 'resources/js/rewards.js'])

</head>

<body>
   <x-rewards.header></x-rewards.header>
   <main class="container">
      {{ $slot }}
   </main>
   <x-rewards.footer></x-rewards.footer>
</body>

</html>
