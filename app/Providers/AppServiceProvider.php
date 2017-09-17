<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $url = Request::url();
        $segments = Request::segments();
        $segment = isset($segments[0]) ? $segments[0] : NULL;
        $url_ro = '';
        $url_ru = '';
        $langs=['ru'];
        if(isset($segments[0]) && in_array($segments[0],$langs)){
            if(isset($slug_url)){
                $count=count($segments);
                $count-=1;
            }
            if(isset($slug_url)){
                $segments[$count]=$slug_url->slug_ru;
            }
            $segments[0]='ro';
            $url_ru = implode('/', $segments);
            if(isset($slug_url)){
                $segments[$count]=$slug_url->slug_en;
            }
            if(isset($slug_url)){
                $segments[$count]=$slug_url->slug_ro;
            }
            unset($segments[0]);
            $url_ro=implode('/',$segments);
        }else{
            if(isset($segments[0])){
                if(isset($slug_url)){
                    $count=count($segments);
                }
                if(isset($slug_url)){
                    $segments[$count-1]=$slug_url->slug_ro;
                }
                $url_ro=implode('/',$segments);
                array_unshift($segments,'ru');
            }else{
                $url_ro='';
                $segments[0]='ru';
                if(isset($count)){
                    $count+1;
                }
            }
            if(isset($slug_url)){
                $segments[$count]=$slug_url->slug_ru;
            }
            $url_ru=implode('/',$segments);
            if(isset($slug_url)){
                $segments[$count]=$slug_url->slug_en;
            }

        }
        view()->share('lang_data',['ro'=>$url_ro,'ru'=>$url_ru,'en'=>$url_ro]);
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
