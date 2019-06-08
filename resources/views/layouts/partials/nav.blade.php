<nav>
  <ul>
    <li class="{{ setNavActiveClass('home') }}">
      <a href="{{ route('home') }}">@lang('Home')</a>
    </li>
    <li class="{{ setNavActiveClass('about') }}">
      <a href="{{route('about')}}">@lang('About')</a>
    </li>
    <li class="{{ setNavActiveClass('projects.*') }}">
      <a href="{{route('projects.index')}}">@lang('Projects')</a>
    </li>
    <li class="{{ setNavActiveClass('messages.create') }}">
      <a href="{{route('messages.create')}}">@lang('Contact')</a>
    </li>
    @auth
      <li class="{{ setNavActiveClass('messages.index') }}">
        <a href="{{route('messages.index')}}">@lang('Messages')</a>
      </li>
      <li>
          <a href="/logout">Cerrar sesión de {{auth()->user()->name}}</a>
      </li>
    @endauth

    @guest
      <li>
          <a href="/login">Login</a>
      </li>
    @endguest

  </ul>
</nav>
