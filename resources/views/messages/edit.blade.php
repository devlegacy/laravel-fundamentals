@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>Editar mensaje</h1>

<form action="{{ route('messages.update',$message->id) }}" method="post">
  @csrf
  @method('put')
  <div>
    <input type="text" name="name" id="" value="{{ $message->name }}" placeholder="Nombre:" title="Nombre" pattern="^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$" required>
    {!! $errors->first('name','<span class="error">:message</span>') !!}
  </div>
  <div>
    <input type="email" name="email" title="Correo eléctronico" id="" value="{{ $message->email }}" placeholder="Correo eléctronico:" required>
    {!! $errors->first('email','<span class="error">:message</span>') !!}
  </div>
  <div>
    <input type="text" name="subject" title="asunto" id="" value="{{ $message->subject }}" placeholder="Asunto:" required>
    {!! $errors->first('subject','<span class="error">:message</span>') !!}
  </div>
  <div>
    <textarea name="content" id="" cols="30" rows="10" placeholder="Mensaje:">{{ $message->content }}</textarea required>
    {!! $errors->first('content','<span class="error">:message</span>') !!}
  </div>
  <button type="submit">Editar</button>
</form>
@endsection
