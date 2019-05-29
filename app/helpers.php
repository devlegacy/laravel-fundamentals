<?php
if (!function_exists('setNavActive')) {
    function setNavActive(String $routeName = 'home')
    {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}

if (!function_exists('routeLocale')) {
    function routeLocale($route, $locale=null): String
    {
        if ($locale) {
            return route($locale.'.'.$route);
        }
        return route(App::getLocale().'.'.$route);
    }
}

if (!function_exists('routeLocaleByLang')) {
    function routeLocaleByLang($route, $locale = null): String
    {
        if ($locale) {
            return route($route, $locale);
        }
        return route($route, App::getLocale());
    }
}

if (!function_exists('getUriByLang')) {
    /**
     * Translate URI
     *
     * @param String $route
     * @param String $locale
     * @return String
     */
    function getUriByLang(String $route, String $locale='en'):String
    {
        return strtolower(str_slug(__(ucfirst($route), [], $locale), '-'));
    };
}

if (!function_exists('getRouteNameByLang')) {
    /**
     * Undocumented function
     *
     * @param String $routeName
     * @param String $lang
     * @return String
     */
    function getRouteNameByLang(String $routeName, String $lang='es'): String
    {
        return "{$lang}.{$routeName}";
    }
}
