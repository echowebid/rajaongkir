<?php

namespace Echowebid\Rajaongkir;

use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap config
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/rajaongkir.php' => config_path() . '/rajaongkir.php',
        ]);
    }

    /**
     * Register bindings in the container
     * @return void
     */
    public function register()
    {
        App::bind('RajaOngkir', function()
        {
            return new RajaOngkir;
        });
    }
}