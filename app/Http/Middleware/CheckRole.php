<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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

       $roles = array_slice (func_get_args (),2);

        /** comprueba si el usuario tiene alguno de los roles que pasamos desde el controller*/
        if (in_array (auth ()->user ()->role_id, $roles ))
        {
            return $next($request);
        }


        return redirect ()->back ();
    }


}
