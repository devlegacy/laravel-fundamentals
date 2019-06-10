@extends('layouts.app')

@section('title','App | '.__('Users'))

@section('content')
<h1>{{$user->name}}</h1>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover ">
      <tbody>
        <tr>
          <td>Nombre:</td>
          <td>{{$user->name}}</td>
        </tr>
        <tr>
          <td>correo eléctronico:</td>
          <td>{{$user->email}}</td>
        </tr>
        <tr>
            <td>Roles:</td>
            <td>
                @foreach ($user->roles as $role)
                  {{$role->display_name}}
                @endforeach
            </td>
          </tr>
      </tbody>
      <tfoot>
        <td colspan="2">
            @can('edit', $user)
              <a class="btn btn-info" href="{{route('users.edit', $user)}}">Editar</a>
            @endcan
        </td>
      </tfoot>
    </table>
</div>

@endsection
