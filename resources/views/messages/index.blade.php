@extends('layouts.app')

@section('title','App | '.__('Contact'))

@section('content')
<h1>Todos los mensajes</h1>

  <table width="100%" border="1">
    <thead>
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
              <td>
                <a href="{{route('messages.edit',$message->id)}}">Editar</a>
                <form style="display:inline;" action="{{route('messages.destroy',$message->id)}}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit">Eliminar</button>
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


@endsection
