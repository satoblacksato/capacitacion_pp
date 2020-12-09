<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;
class ChangeLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        App::setLocale(session()->get('lang','es'));
        return $next($request);
    }
}
