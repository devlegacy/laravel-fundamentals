<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Laravel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ setNavActiveClass('home') }}">
          <a class="nav-link" href="{{ route('home') }}">@lang('Home')</a>
        </li>
        <li class="nav-item {{ setNavActiveClass('about') }}">
          <a class="nav-link" href="{{route('about')}}">@lang('About')</a>
        </li>
        <li class="nav-item {{ setNavActiveClass('projects.*') }}">
          <a class="nav-link" href="{{route('projects.index')}}">@lang('Projects')</a>
        </li>
        <li class="nav-item {{ setNavActiveClass('messages.create') }}">
          <a class="nav-link" href="{{route('messages.create')}}">@lang('Contact')</a>
        </li>
        @auth
          <li class="nav-item {{ setNavActiveClass('messages.index') }} {{ setNavActiveClass('messages.edit') }}">
            <a class="nav-link" href="{{route('messages.index')}}">@lang('Messages')</a>
          </li>
        @endauth
      </ul>
      <ul class="navbar-nav">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
        @endguest
        @auth
            <li class="nav-item">
                <a class="nav-link" href="/logout">Cerrar sesión de {{auth()->user()->name}}</a>
            </li>
        @endauth
      </ul>
  </div>
</nav>
