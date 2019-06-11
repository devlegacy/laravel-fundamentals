@extends('layouts.app')

@section('title','App | '.__('Users'))

@section('content')
  <h1>Crear usuarios</h1>
  <form class="needs-validation" action="{{ route('users.store') }}" method="post" novalidate>
    @include('users.partials.form', ['user' => new App\User()])
    <button type="submit" class="btn btn-primary">Guardar</button>
  </form>
@endsection
