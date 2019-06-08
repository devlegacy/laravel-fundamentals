<?php
if (!function_exists('setNavActiveClass')) {
    /**
     * Return the css class for route name active
     *
     * @param String $routeName
     * @return String
     */
    function setNavActiveClass(String $routeName = 'home') : String
    {
        // return request()->routeIs(App::getLocale().".{$routeName}") ? 'active' : '';
        return request()->routeIs($routeName) ? 'active' : '';
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
    function routeLocale(String $route, $data=null, String $locale=null): String
    {
        // * Note: Read more about Route::class => https://laravel.com/api/5.8/Illuminate/Routing/Route.html

        if ($locale) {
            return route("{$locale}.{$route}", $data);
        }
        return route(app()->getLocale().".{$route}", $data);
    }
}

if (!function_exists('currentRoute')) {
    function currentRoute($lang='en') : String
    {
        return routeLocale(substr(Route::currentRouteName(), 3), Route::current()->parameters, $lang);
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
