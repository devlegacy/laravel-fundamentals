@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>Usuarios</h1>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover ">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo eléctronico</th>
        <th>Rol</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

        @forelse ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>
                <a href="{{route('users.show',$user->id)}}">{{$user->name}}</a>
              </td>
              <td>{{$user->email}}</td>
              <td>
                @foreach ($user->roles as $role)
                    {{$role->display_name}}
                @endforeach
              </td>
              <td class="d-flex justify-content-around">
                <a class="btn btn-warning btn-sm" href="{{route('users.edit',$user->id)}}"><i class="fas fa-edit"></i> Editar</a>
                <form action="{{route('users.destroy',$user->id)}}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
              </td>
            </tr>
        @empty
            <tr>
              <td colspan="6">
                <h4>Sin mensajes para mostrar</h4>
              </td>
            </tr>
        @endforelse
    </tbody>
  </table>
</div>

@endsection
