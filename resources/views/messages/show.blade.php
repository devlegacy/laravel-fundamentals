@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')

<h1>Mensaje</h1>
<p>Enviado por: {{$message->present()->getUserName()}} &lt;{{$message->present()->getUserEmail()}}&gt; </p>
<p>{{ $message->content }}</p>

@endsection
