@extends('layouts.app')

@section('title','App | '.__('Portfolio'))

@section('content')
<h1>@lang('Create new project')</h1>
  <form method="POST" action="{{ routeLocale('projects.store') }}">
    @csrf
    <div>
      <label for="title">Título del proyecto</label>
      <input type="text" name="title" id=""/>
    </div>
    <div>
      <label for="description">Descripción</label>
      <textarea name="description" id="" cols="30" rows="10"></textarea>
    </div>
    <button type="submit">Crear</button>
  </form>
@endsection
