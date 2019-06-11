@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>@lang('Contact')</h1>

@if (session()->has('info'))
    <h3>{{session('info')}}</h3>
@endif

<form class="needs-validation" action="{{ route('messages.store') }}" method="post" novalidate>
  @csrf
  @guest
  <div class="form-group">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="name" class="form-control  {{$errors->has('name') ? 'is-invalid': 'is-valid'}}" value="{{ old('name') }}" placeholder="Nombre:" title="Nombre" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
    {!! $errors->first('name','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <div class="form-group">
    <label for="email">Correo eléctronico:</label>
    <input type="email" name="email" title="Correo eléctronico" id="email" class="form-control {{$errors->has('email') ? 'is-invalid': 'is-valid'}}" value="{{ old('email') }}" placeholder="Correo eléctronico:" required>
    {!! $errors->first('email','<div class="invalid-feedback">:message</div>') !!}
  </div>
  @endguest
  <div class="form-group">
    <label for="subject">Asunto:</label>
    <input type="text" name="subject" title="asunto" id="subject" class="form-control {{$errors->has('subject') ? 'is-invalid': 'is-valid'}}" value="{{ old('subject') }}" placeholder="Asunto:" required>
    {!! $errors->first('subject','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <div class="form-group">
    <label for="content">Mensaje:</label>
    <textarea name="content" id="content" class="form-control {{$errors->has('content') ? 'is-invalid': 'is-valid'}}" cols="30" rows="10" minlength="2" placeholder="Mensaje:" required>{{ old('content') }}</textarea>
    {!! $errors->first('content','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
@endsection
