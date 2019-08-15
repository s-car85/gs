<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path().'/public_html';
          });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Request::segment(1) == 'prodavnica'){

        }

        if(Request::segment(1) == 'gs-kutija'){

        }

        /////View::composer('pages.partials.clients._test', 'App\Http\ViewComposers\TestimonialComposer');
    }
}
