@extends('layouts.app')

@section('title','App | '.__('Museums'))

@section('content')
<h1>@lang('Museums')</h1>
@if (session()->has('info'))
  <div class="alert alert-success" role="alert">
     {{session('info')}}
  </div>
@endif
  <div class="container">
      <div class="row">
          @foreach($museums as $museum)
              <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                  <div class="card b-museum">
                      @if( $museum->thumbnail )
                          <figure class="b-museum__thumbnail">
                              <a href="{{route("museums.show", $museum->id)}}">
                                  <img class="card-img-top img-responsive" src="{{ $museum->thumbnail }}"
                                      alt="{{ $museum->name }}">
                              </a>
                          </figure>
                      @endif

                      <div class="card-body b-museum-information">
                          <a href="{{route("museums.show", $museum->id)}}">
                              <h2 class="b-museum__name">
                                  {{ $museum->name }}
                              </h2>
                          </a>
                          <div class="b-museum__description">
                              {{ $museum->description }}
                          </div>

                          <div class="b-museum__hours">
                              <strong>Hours: </strong> {{ $museum->hours }}
                          </div>

                          <div class="b-museum__phone">
                              <strong>Phone: </strong> {{ $museum->phone }}
                          </div>
                          <div class="b-museum__ranking">
                              <strong>Rating: </strong> {{ $museum->rating }}
                          </div>
                      </div>
                  </div>
              </div>
          @endforeach

      </div>
  </div>
@endsection
