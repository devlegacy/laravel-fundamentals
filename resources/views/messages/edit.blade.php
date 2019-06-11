@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>Editar mensaje</h1>

<form class="needs-validation" action="{{ route('messages.update',$message->id) }}" method="post" novalidate>
  @method('put')
  @include('messages.partials.form',[
    'btnText' => 'Actualizar',
    'showFields' => !$message->user_id,
    ])
</form>
@endsection
