<?php

namespace ikepu_tp\ShorterUrl;

use Illuminate\Support\ServiceProvider;

class ShorterUrlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/config/shorter-url.php', 'shorter-url');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPublishing();
        $this->defineRoutes();
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . "/resources/views", "ShorterUrl");
    }

    /**
     * Register the package's publishable resources.
     */
    private function registerPublishing()
    {
        if (!$this->app->runningInConsole()) return;

        $this->publishes([
            __DIR__ . '/config/shorter-url.php' => base_path('config/shorter-url.php'),
        ], 'shorterUrl-config');

        $migrations = [
            "2023_08_12_080000_create_links_table.php",
            "2023_08_12_080001_create_accesses_table.php",
        ];
        foreach ($migrations as $migration) {
            $this->publishes([
                __DIR__ . "/database/migrations/{$migration}" => database_path(
                    "migrations/{$migration}"
                ),
            ], 'migrations');
        }

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/ShorterUrl'),
        ], 'shorterUrl-views');

        $this->publishes([
            __DIR__ . '/resources/css' => public_path('assets/css/vendor/ShorterUrl'),
            //__DIR__ . '/resources/js' => public_path('assets/js/vendor/ShorterUrl'),
        ], 'shorterUrl-assets');
    }

    /**
     * Define the Sanctum routes.
     *
     * @return void
     */
    protected function defineRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php");
    }
}
