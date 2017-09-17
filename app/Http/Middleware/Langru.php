<?php

namespace App\Http\Middleware;

use Closure;
use Lang;
use Request;
use Redirect;
class Langru
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
        $locale = $request->segment(1);

        $url = Request::url();
        $segments = Request::segments();
        $segment = isset($segments[0]) ? $segments[0] : NULL;

        $url_ro = '';
        $url_en = '';
        $url_ru = '';
        if( !$segment ){
            $url_ro = $url . '/ro';
            $url_en = $url ;
            $url_ru = $url. '/ru';
        } else {
            if (strpos($url, '/ro') !== false || strpos($url, '/ru') !== false || strpos($url, '/en') !== false) {

                $segments[0] = 'ro';
                $url_ro = implode('/', $segments);
                unset($segments[0]);
                $segments[0] = 'ru';
                $url_ru = implode('/', $segments);
                unset($segments[0]);
                $url_en = implode('/', $segments);
                unset($segments[0]);
                if (strpos($url, '/en') !== false) {
                    return Redirect::To($url_en);
                }
            }
        }
//

        return $next($request);
    }
}
