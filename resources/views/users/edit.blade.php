@extends('layouts.app')

@section('title','App | '.__('Users'))

@section('content')
<h1>Editar usuario</h1>
@if (session()->has('info'))
    <div class="alert alert-success">
      {{ session('info') }}
    </div>
@endif

<form class="needs-validation" action="{{ route('users.update',$user->id) }}" method="post" novalidate>
    @method('put')
    @include('users.partials.form')
    <button type="submit" class="btn btn-primary">Editar</button>
  </form>
@endsection
