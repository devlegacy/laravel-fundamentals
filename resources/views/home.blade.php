@extends('layouts.app')

@section('title','App | '.__('Home'))

@section('content')
<h1>@lang('Home')</h1>
Bienvenido {{ $name ?? 'Invitado' }}
@endsection
