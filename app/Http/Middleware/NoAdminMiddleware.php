<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class NoAdminMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() ){

            if( Auth::user()->role==0){
                return $next($request);
            } else{
                return Redirect::route('admin');
            }

        } else {
            return $next($request);
        }

    }

}