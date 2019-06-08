<nav>
  <ul>
    <li class="{{ setNavActiveClass('home') }}">
      <a href="{{ routeLocale('home') }}">@lang('Home')</a>
    </li>
    <li class="{{ setNavActiveClass('about') }}">
      <a href="{{routeLocale('about')}}">@lang('About')</a>
    </li>
    <li class="{{ setNavActiveClass('projects.*') }}">
      <a href="{{routeLocale('projects.index')}}">@lang('Projects')</a>
    </li>
    <li class="{{ setNavActiveClass('messages.create') }}">
      <a href="{{routeLocale('messages.create')}}">@lang('Contact')</a>
    </li>
    @auth
      <li class="{{ setNavActiveClass('messages.index') }}">
        <a href="{{routeLocale('messages.index')}}">@lang('Messages')</a>
      </li>
      <li>
          <a href="/logout">Cerrar sesión</a>
        </li>
    @endauth
    <li>
        @guest
            <a href="/login">Login</a>
        @endguest
    </li>
  </ul>
</nav>
