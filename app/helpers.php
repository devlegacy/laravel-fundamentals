<?php
if (!function_exists('setNavActive')) {
    /**
     * Return the css class for route name active
     *
     * @param String $routeName
     * @return String
     */
    function setNavActiveClass(String $routeName = 'home') : String
    {
        return request()->routeIs(App::getLocale().".{$routeName}") ? 'active' : '';
    }
}

if (!function_exists('routeLocale')) {
    /**
     * Alias for route() helper function using a locale prefex
     *
     * @param String $route
     * @param String $locale
     * @return String
     */
    function routeLocale(String $route, String $locale=null): String
    {
        if ($locale) {
            return route("{$locale}.{$route}");
        }
        return route(App::getLocale().".{$route}");
    }
}

if (!function_exists('currentRoute')) {
    function currentRoute($lang='en') : String
    {
        return routeLocale(substr(Route::currentRouteName(), 3), $lang);
    }
}

/**
 * Helpers for translate routes
 */
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
