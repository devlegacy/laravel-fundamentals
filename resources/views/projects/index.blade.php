@extends('layouts.app')

@section('title','App | '.__('Portfolio'))

@section('content')
<h1>@lang('Portfolio')</h1>

<ul>
  @forelse ($projects as $project)
  <li><a href="{{route('projects.show',$project)}}">{{ $project->title }}</a></li>
   {{--  <li><small>{{$project->description}}</small></li>
    <pre>
      @dump($loop)
    </pre>
    <small>{{ $loop->last ? 'Es el último elemento' : '' }}</small> --}}
  @empty
    <p>No hay proyectos para mostart</p>
  @endforelse
</ul>
{{ $projects->links() }}
@endsection
