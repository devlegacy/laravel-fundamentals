@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>@lang('Contact')</h1>

<form action="{{ route('contact.store') }}" method="post">
  @csrf
  <div>
    <input type="text" name="name" id="" value="{{ old('name') }}" placeholder="Nombre:" required>
    {!! $errors->first('name','<small>:message</small>') !!}
  </div>
  <div>
    <input type="email" name="email" id="" value="{{ old('email') }}" placeholder="Correo eléctronico:" required>
    {!! $errors->first('email','<small>:message</small>') !!}
  </div>
  <div>
    <input type="text" name="subject" id="" value="{{ old('subject') }}" placeholder="Asunto:" required>
    {!! $errors->first('subject','<small>:message</small>') !!}
  </div>
  <div>
    <textarea name="content" id="" cols="30" rows="10" placeholder="Mensaje:">{{ old('content') }}</textarea required>
    {!! $errors->first('content','<small>:message</small>') !!}
  </div>
  <button type="submit">Enviar</button>
</form>
@endsection