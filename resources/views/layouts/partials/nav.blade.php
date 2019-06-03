<nav>
  <ul>
    <li class="{{ setNavActiveClass('home') }}">
      <a href="{{ routeLocale('home') }}">@lang('Home')</a>
    </li>
    <li class="{{ setNavActiveClass('about') }}">
      <a href="{{routeLocale('about')}}">@lang('About')</a>
    </li>
    <li class="{{ setNavActiveClass('portfolio') }}">
      <a href="{{routeLocale('portfolio.index')}}">@lang('Portfolio')</a>
    </li>
    <li class="{{ setNavActiveClass('contact') }}">
      <a href="{{routeLocale('contact')}}">@lang('Contact')</a>
    </li>
  </ul>
</nav>
