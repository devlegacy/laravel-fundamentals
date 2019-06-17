@extends('layouts.app')

@section('title','App | '.__('Museums'))

@section('content')
<h1>@lang('Create museums')</h1>
@if (session()->has('error'))
  <div class="alert alert-danger" role="alert">
     {{session('error')}}
  </div>
@endif
<form method="POST" action="{{ route('museums.store') }}"  class="needs-validation" novalidate>
  @csrf
  <div class="form-group">
    <label for="name">Nombre:</label>
    <input
            type="text"
            name="name"
            id=""
            id="name"
            class="form-control  {{$errors->has('name') ? 'is-invalid': 'is-valid'}}"
            value="{{ old('name') }}"
            placeholder="Nombre:"
            title="Nombre"
            pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$"
            required >
    {!! $errors->first('name','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <div class="form-group">
    <label for="description">Descripción:</label>
    <textarea
              name="description"
              id="description"
              class="form-control {{$errors->has('description') ? 'is-invalid': 'is-valid'}}"
              cols="30"
              rows="10"
              placeholder="Descripción:"
              minlength="2"
              required >{{ old('description') }}</textarea>
    {!! $errors->first('description','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
