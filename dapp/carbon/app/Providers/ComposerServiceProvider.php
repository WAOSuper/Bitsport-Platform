<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.layouts.sidebar','App\Http\ViewComposers\Sidebar');
        View::composer('frontend.layouts.footer','App\Http\ViewComposers\Footer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
