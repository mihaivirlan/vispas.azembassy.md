<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class UserMiddleware
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

            if( Auth::guard('user')->check()){
                return $next($request);
            } else{
                return Redirect::route('/');
            }
        }

}