<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
class CanContactUs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$day)
    {
        if(in_array(Carbon::now()->dayOfWeek,$day)){
            return $next($request);
        }
        abort(401,'No puedes enviar mensajes al administrador el día de hoy');
    }
}
