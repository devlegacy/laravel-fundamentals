<nav class="navbar navbar-expand-lg navbar-dark bg-dark box-shadow">
  <div class="container">
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
              @if (auth()->user()->hasRoles(['administrador']))
                <li class="nav-item {{ setNavActiveClass('users.*') }}">
                  <a class="nav-link" href="{{route('users.index')}}">@lang('Users')</a>
                </li>
              @endif
            @endauth
          </ul>
          <ul class="navbar-nav">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
            @endguest
            @auth
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{auth()->user()->name}}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/usuario/{{auth()->id()}}/editar">Mi cuenta</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">Cerrar sesión</a>
                  </div>
                </li>
            @endauth
          </ul>
      </div>
  </div>
</nav>
