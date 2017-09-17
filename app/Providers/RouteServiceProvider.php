<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Config;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Lang;
use App;
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }



    public function map(Router $router, Request $request, Application $app)

    {
        $locale = $request->segment(1);
        if(! array_key_exists( $locale, Config::get('app.locales') )){
            $locale =  Config::get('app.locale');
            $app->setLocale($locale);
            $router->group(['namespace' => $this->namespace, 'prefix' => '','middleware' => 'web'], function ($router) {
                require base_path('routes/web.php');
            });

        } else {
            $app->setLocale($locale);
            $router->group(['namespace' => $this->namespace, 'prefix' => $locale,'middleware' => 'web' ],
                function ($router) {
                    require base_path('routes/web.php');
                });
        }
        //$this->mapWebRoutes($router);
        $lang=Lang::getLocale();
        view()->share('name_user','name_'.$lang);
        view()->share('title_user','title_'.$lang);
        view()->share('service_user','service_'.$lang);
        view()->share('mini_deascription_user','min_description_'.$lang);
        view()->share('slug_user','slug_'.$lang);
        view()->share('description_user','description_'.$lang);
        view()->share('mini_description_user','mini_description_'.$lang);
        view()->share('meta_description_user','meta_description_'.$lang);
        view()->share('url_user','url_'.$lang);
        view()->share('text_user','text_'.$lang);
        view()->share('image_user','image_'.$lang);
        view()->share('street_user','street_'.$lang);
        view()->share('contact',App\Contact::first());
        view()->share('about',App\Page::findOrFail(4));
        view()->share('hotel',App\Page::findOrFail(7));
        view()->share('conference',App\Page::findOrFail(8));

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */

    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}