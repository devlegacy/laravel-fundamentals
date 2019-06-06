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
    <li class="{{ setNavActiveClass('contact.*') }}">
      <a href="{{routeLocale('contact.index')}}">@lang('Contact')</a>
    </li>
  </ul>
</nav>
