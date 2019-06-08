<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title','Default title')</title>
  <link rel="stylesheet" href="/css/app.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
  {{-- @include('partials.test') --}}
  {{-- @include('layouts.partials.lang') --}}
  @include('layouts.partials.nav')
  <main role="main">
      <div class="container">
          @yield('content')
      </div>
  </main>
  <footer class="text-muted">
      <div class="container">
          Copyright © {{ date('Y') }}
      </div>
  </footer>
  <script src="/js/app.js"></script>
</body>
</html>
