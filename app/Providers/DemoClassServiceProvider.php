<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App;
class DemoClassServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         App::bind('democlass', function()
        {
            return new \App\ItSolution\DemoClass;
        });
    }
}
