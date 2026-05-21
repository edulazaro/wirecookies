<?php

namespace EduLazaro\WireCookies;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WireCookiesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/wirecookies.php', 'wirecookies');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'wirecookies');

        // Registramos el componente como `<x-wirecookies />` (sin namespace
        // explícito en la blade del consumidor).
        Blade::component('wirecookies::components.wirecookies', 'wirecookies');

        $this->publishes([
            __DIR__ . '/../config/wirecookies.php' => config_path('wirecookies.php'),
        ], 'wirecookies-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/wirecookies'),
        ], 'wirecookies-views');

        $this->publishes([
            __DIR__ . '/../resources/css/wirecookies.css' => resource_path('css/vendor/wirecookies.css'),
        ], 'wirecookies-css');
    }
}
