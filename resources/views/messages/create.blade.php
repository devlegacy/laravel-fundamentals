@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>@lang('Contact')</h1>

@if (session()->has('info'))
    <h3>{{session('info')}}</h3>
@endif

<form action="{{ routeLocale('messages.store') }}" method="post">
  @csrf
  <div>
    <input type="text" name="name" id="" value="{{ old('name') }}" placeholder="Nombre:" title="Nombre" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
    {!! $errors->first('name','<span class="error">:message</span>') !!}
  </div>
  <div>
    <input type="email" name="email" title="Correo eléctronico" id="" value="{{ old('email') }}" placeholder="Correo eléctronico:" required>
    {!! $errors->first('email','<span class="error">:message</span>') !!}
  </div>
  <div>
    <input type="text" name="subject" title="asunto" id="" value="{{ old('subject') }}" placeholder="Asunto:" required>
    {!! $errors->first('subject','<span class="error">:message</span>') !!}
  </div>
  <div>
    <textarea name="content" id="" cols="30" rows="10" placeholder="Mensaje:">{{ old('content') }}</textarea required>
    {!! $errors->first('content','<span class="error">:message</span>') !!}
  </div>
  <button type="submit">Enviar</button>
</form>
@endsection
