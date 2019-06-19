@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')

<h1>Mensaje</h1>
<p>Enviado por: {{$message->name ?? $message->user->name}} &lt;{{$message->email ?? $message->user->email}}&gt; </p>
<p>{{ $message->content }}</p>

@endsection
