<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Store')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
  @include('partials.header')
  @include('partials.nav')

  <main class="container">
    @yield('content')
  </main>

  @include('partials.footer')
</body>
</html>