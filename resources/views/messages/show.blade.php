@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>Mnesaje</h1>
<p>Enviado por: {{$message->name}} &lt;{{$message->email}}&gt; </p>
<p>{{ $message->content }}</p>

@endsection
