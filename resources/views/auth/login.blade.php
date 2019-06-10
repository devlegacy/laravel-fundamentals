@extends('layouts.app')
@section('title','App | '.__('Login'))
@section('content')
<form action="/login" method="post">
  @csrf
  <div class="form-group">
    <label for="email">Correo eléctronico:</label>
    <input type="text" name="email" id="email" class="form-control" placeholder="Correo eléctronico" id=""/>
  </div>
  <div class="form-group">
    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" id="">
  </div>
  <button class="btn btn-primary" type="submit">Login</button>
</form>
@endsection
