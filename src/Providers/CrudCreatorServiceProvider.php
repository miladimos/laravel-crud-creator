<?php

namespace Miladimos\CrudCreator\Providers;

use Illuminate\Support\ServiceProvider;
use Miladimos\CrudCreator\Console\Commands\InstallPackageCommand;
use Miladimos\CrudCreator\Console\Commands\MakeCRUDCommand;
use Miladimos\CrudCreator\CrudCreator;

class CrudCreatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/crud-creator.php", 'crud-creator');

        $this->registerFacades();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->registerPublishes();

            $this->registerCommands();
        }
    }

    private function registerFacades()
    {
        $this->app->bind('crud-creator', function ($app) {
            return new CrudCreator();
        });
    }

    private function registerPublishes()
    {
        $this->publishes([
            __DIR__ . '/../../config/crud-creator.php' => config_path('crud-creator.php')
        ], 'crud-creator-config');

        $this->publishes([
            __DIR__ . '/../Console/Stubs' => resource_path('vendor/miladimos/laravel-crud-creator/stubs'),
        ], 'crud-creator-stubs');
    }

    public function registerCommands()
    {
        $this->commands([
            InstallPackageCommand::class,
            MakeCRUDCommand::class,
        ]);
    }

    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen') === true;
    }
}
