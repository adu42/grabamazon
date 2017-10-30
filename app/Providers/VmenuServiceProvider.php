<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Lavary\Menu\ServiceProvider;
use Lavary\Menu\Menu;


class VmenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
      //  $this->package('Lavary/Menu');
        parent::boot();
    }

    public function register()
    {
        parent::register();
        $this->app->singleton('Vmenu', function($app) {
            return new Menu;
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('Vmenu');
    }
}
