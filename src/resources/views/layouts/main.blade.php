<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <link rel="preload" as="style" href="{{ route('shorter-url.asset', ['file' => 'style.css']) }}" />
  <link rel="modulepreload" href="{{ route('shorter-url.asset', ['file' => 'main.js']) }}" />
  <link rel="stylesheet" href="{{ route('shorter-url.asset', ['file' => 'style.css']) }}" />
  <script type="module" src="{{ route('shorter-url.asset', ['file' => 'main.js']) }}"></script>

</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <main>
      @yield('content')
    </main>
  </div>
</body>

</html>
