@extends('layouts.app')

@section('title','App | '.__('Museums'))

@section('content')
<h1>@lang('Museums')</h1>
@if (session()->has('info'))
  <div class="alert alert-success" role="alert">
     {{session('info')}}
  </div>
@endif

@endsection
