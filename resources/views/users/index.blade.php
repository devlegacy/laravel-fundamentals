@extends('layouts.app')

@section('title','App | '.__('Users'))

@section('content')
<h1>Usuarios</h1>
<a class="btn btn-primary float-right" href="{{route('users.create')}}">Crear usuario</a>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover ">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo eléctronico</th>
        <th>Rol</th>
        <th>Notas</th>
        <th>Tags</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>

        @forelse ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->present()->link()}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->present()->roles()}}</td>
              <td>{{$user->present()->notes()}}</td>
              <td>{{$user->present()->tags()}}</td>
              <td class="d-flex justify-content-around">
                @can('edit', $user)
                <a class="btn btn-warning btn-sm" href="{{route('users.edit',$user->id)}}"><i class="fas fa-edit"></i> Editar</a>
                @endcan

                @can('destroy', $user)
                <form action="{{route('users.destroy',$user->id)}}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
                @endcan
              </td>
            </tr>
        @empty
            <tr>
              <td colspan="7">
                <h4>Sin mensajes para mostrar</h4>
              </td>
            </tr>
        @endforelse
    </tbody>
  </table>
</div>

@endsection
