<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Http\Middleware;

use Closure;

class CkeckAccesoCreateExpediente
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
        if(!$request->user ()->funcionario || !$request->user ()->area || !in_array($request->user ()->role_id, [1,2]))
        {
            return redirect ('expedientes');
        }

        return $next($request);
    }
}
