@extends('layouts.app')

@section('title','App | '.__('Portfolio'))

@section('content')
<h1>@lang('Portfolio')</h1>

<ul>
  @forelse ($portfolio as $project)
    <li>{{ $project['title'] }}</li>
    <pre>
      @dump($loop)
    </pre>
    <small>{{ $loop->last ? 'Es el último elemento' : '' }}</small>
  @empty
    <p>No hay proyectos para mostart</p>
  @endforelse
</ul>
@endsection
