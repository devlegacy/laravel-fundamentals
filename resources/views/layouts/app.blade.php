<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title','Default title')</title>

  <style>
    .active a{
      color:red;
      text-decoration: none;
    }
  </style>
</head>
<body>
  {{-- @include('partials.test') --}}
  @include('layouts.partials.lang')
  @include('layouts.partials.nav')
  @yield('content')
</body>
</html>
