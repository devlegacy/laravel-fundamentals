@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>Todos los mensajes</h1>
<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover ">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Asunto</th>
        <th>Correo eléctronico</th>
        <th>Mensaje</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($messages as $message)
            <tr>
              <td>{{$message->id}}</td>
              <td>
                <a href="{{route('messages.show',$message->id)}}">{{$message->name}}</a>
              </td>
              <td>{{$message->subject}}</td>
              <td>{{$message->email}}</td>
              <td>{{$message->content}}</td>
              <td class="d-flex justify-content-around">
                <a class="btn btn-warning btn-sm" href="{{route('messages.edit',$message->id)}}"><i class="fas fa-edit"></i> Editar</a>
                <form action="{{route('messages.destroy',$message->id)}}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i> Eliminar</button>
                </form>
              </td>
            </tr>
        @empty
            <tr>
              <td colspan="4">
                <h4>Sin mensajes para mostrar</h4>
              </td>
            </tr>
        @endforelse
    </tbody>
  </table>
</div>

@endsection
