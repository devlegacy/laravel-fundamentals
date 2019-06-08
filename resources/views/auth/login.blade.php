@extends('layouts.app')
@section('content')
<form action="/login" method="post">
  @csrf
  <div>
    <input type="text" name="email" placeholder="Correo eléctronico" id=""/>
  </div>
  <div>
    <input type="password" name="password" placeholder="Contraseña" id="">
  </div>
  <button type="submit">Login</button>
</form>
@endsection
