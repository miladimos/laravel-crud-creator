<?php

namespace Miladimos\CrudCreator\Providers;

use Illuminate\Support\ServiceProvider;
use Miladimos\CrudCreator\Console\Commands\InstallPackageCommand;
use Miladimos\CrudCreator\Console\Commands\MakeCrudCreatorCommand;
use Miladimos\CrudCreator\CrudCreator;

class CrudCreatorServiceProvider extends ServiceProvider
{

    public static $packagePath = null;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/crud_creator.php", 'crud_creator');

        $this->registerFacades();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        self::$packagePath = dirname(__DIR__);

        if ($this->app->runningInConsole()) {

            $this->registerPublishes();

            $this->registerCommands();

        }
    }

    private function registerFacades()
    {
        $this->app->bind('crud_creator', function ($app) {
            return new CrudCreator();
        });
    }

    private function registerPublishes()
    {
        $this->publishes([
            __DIR__ . '/../../config/crud_creator.php' => config_path('crud_creator.php')
        ], 'crud_creator-config');

        $this->publishes([
            __DIR__.'/../Console/Stubs' => resource_path('vendor/miladimos/crud_creator/stubs'),
        ], 'crud_creator-stubs');
    }

    public function registerCommands()
    {
        $this->commands([
            InstallPackageCommand::class,
            MakeCrudCreatorCommand::class,
        ]);
    }

        /**
     * Check if package is running under Lumen app
     *
     * @return bool
     */
    protected function isLumen()
    {
        return str_contains($this->app->version(), 'Lumen') === true;
    }
}
