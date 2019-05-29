<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $locale = substr(trim(request()->getPathinfo(), '/'), 0, 2);
        $locale = $request->segment(1);
        \App::setLocale($locale);
        return $next($request);
    }
}
