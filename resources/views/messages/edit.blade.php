@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>Editar mensaje</h1>

<form class="needs-validation" action="{{ route('messages.update',$message->id) }}" method="post" novalidate>
  @csrf
  @method('put')
  <div class="form-group">
    <label for="name">Nombre:</label>
    <input type="text" name="name" id="" id="name" class="form-control  {{$errors->has('name') ? 'is-invalid': 'is-valid'}}" value="{{ $message->name }}" placeholder="Nombre:" title="Nombre" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
    {!! $errors->first('name','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <div class="form-group">
    <label for="email">Correo eléctronico:</label>
    <input type="email" name="email" id="email" class="form-control  {{$errors->has('email') ? 'is-invalid': 'is-valid'}}" title="Correo eléctronico" value="{{ $message->email }}" placeholder="Correo eléctronico:" required>
    {!! $errors->first('email','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <div class="form-group">
    <label for="subject">Asunto:</label>
    <input type="text" name="subject" id="subject" class="form-control  {{$errors->has('subject') ? 'is-invalid': 'is-valid'}}" title="asunto" value="{{ $message->subject }}" placeholder="Asunto:" required>
    {!! $errors->first('subject','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <div class="form-group">
    <label for="content">Mensaje:</label>
    <textarea name="content" id="content" class="form-control  {{$errors->has('content') ? 'is-invalid': 'is-valid'}}" cols="30" rows="10" placeholder="Mensaje:">{{ $message->content }}</textarea required>
    {!! $errors->first('content','<div class="invalid-feedback">:message</div>') !!}
  </div>
  <button type="submit" class="btn btn-primary">Editar</button>
</form>
@endsection
