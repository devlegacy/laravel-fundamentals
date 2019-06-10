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
    @csrf
    @method('put')
    <div class="form-group">
      <label for="name">Nombre:</label>
      <input type="text" name="name" id="" id="name" class="form-control  {{$errors->has('name') ? 'is-invalid': 'is-valid'}}" value="{{ $user->name }}" placeholder="Nombre:" title="Nombre" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
      {!! $errors->first('name','<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group">
      <label for="email">Correo eléctronico:</label>
      <input type="email" name="email" id="email" class="form-control  {{$errors->has('email') ? 'is-invalid': 'is-valid'}}" title="Correo eléctronico" value="{{ $user->email }}" placeholder="Correo eléctronico:" required>
      {!! $errors->first('email','<div class="invalid-feedback">:message</div>') !!}
    </div>

    <button type="submit" class="btn btn-primary">Editar</button>
  </form>
@endsection
