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
        $this->mergeConfigFrom(__DIR__ . "/../../config/repository.php", 'repository');

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
        $this->app->bind('repository', function ($app) {
            return new CrudCreator();
        });
    }

    private function registerPublishes()
    {
        $this->publishes([
            __DIR__ . '/../../config/repository.php' => config_path('repository.php')
        ], 'repository-config');

        $this->publishes([
            __DIR__.'/../Console/Stubs' => resource_path('vendor/miladimos/repository/stubs'),
        ], 'repository-stubs');
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
