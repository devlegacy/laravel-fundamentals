@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>@lang('Contact')</h1>

@if (session()->has('info'))
    <h3>{{session('info')}}</h3>
@endif

<form class="needs-validation" action="{{ route('messages.store') }}" method="post" novalidate>
  @include('messages.partials.form', ['showFields' => auth()->guest()])
</form>
@endsection
