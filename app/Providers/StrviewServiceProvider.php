<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Ado\Libraries\StringView;

class StrviewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->singleton('stringview', function(){
            return new StringView();
        });
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
