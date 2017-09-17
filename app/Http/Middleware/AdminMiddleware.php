<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class AdminMiddleware
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
        if(Auth::user() ){

            if( Auth::user()->role && Auth::user()->status){
                return $next($request);
            } else{
                return Redirect::route('admin/login');
            }

        } else {
            return Redirect::route('admin/login');
        }

    }

}