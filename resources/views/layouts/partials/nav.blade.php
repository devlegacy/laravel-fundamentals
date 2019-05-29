<nav>
  <ul>
    <li class="{{ setNavActive('home') }}">
      <a href="{{ routeLocale('home') }}">@lang('Home')</a>
    </li>
    <li class="{{ setNavActive('about') }}">
      <a href="{{routeLocale('about')}}">@lang('About')</a>
    </li>
    <li class="{{ setNavActive('portfolio') }}">
      <a href="{{routeLocale('portfolio')}}">@lang('Portfolio')</a>
    </li>
    <li class="{{ setNavActive('contact') }}">
      <a href="{{routeLocale('contact')}}">@lang('Contact')</a>
    </li>
  </ul>
</nav>
