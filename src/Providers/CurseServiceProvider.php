<?php

namespace Curse\Providers;

use Curse\App\Curse;
use Illuminate\Support\ServiceProvider;

class CurseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Curse', function () {
            return new Curse();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    { }
}
