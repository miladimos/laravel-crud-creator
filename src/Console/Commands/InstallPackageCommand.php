<?php

namespace Miladimos\CrudCreator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallPackageCommand extends Command
{

    protected $signature = "crud:install";

    protected $name = 'Install crud_creator Package';

    protected $description = 'Simply Install laravel-crud-creator Package';

    public function handle()
    {
        $this->warn("laravel-crud-creator package installing started...");

        //config
        if (File::exists(config_path('crud-creator.php'))) {
            $confirmConfig = $this->confirm("crud-creator.php already exist. you must overwrite it! Are you ok?");
            if ($confirmConfig) {
                $this->publishConfig();
                $this->info("config publish/overwrite finished");
            } else {
                $this->error("you must publish and overwrite config file");
                die;
            }
        } else {
            $this->publishConfig();
            $this->info("config published");
        }

        // stub files
        $confirmStub = $this->confirm("You must publish/overwrite stubs files!");
        if ($confirmStub) {
            if (File::isDirectory(resource_path('vendor/miladimos/laravel-crud-creator/stubs'))) {
                $confirmConfig = $this->confirm("stubs files already exist. you must overwrite it! Are you ok?");
                if ($confirmConfig) {
                    $this->publishStubs();
                    $this->info("stubs publish/overwrite finished");
                    die;
                } else {
                    $this->error("you must publish and overwrite stubs file");
                    die;
                }
            }
            $this->publishStubs();
            $this->info("stub files published!");
        } else {
            $this->error("you must publish and overwrite stubs file");
            die;
        }

        $this->info("laravel-crud-creator package installed successfully! please star me on github! -> https://github.com/miladimos/laravel-crud-creator");

        return 0;
    }

    private function publishConfig()
    {
        $this->call('vendor:publish', [
            '--provider' => "Miladimos\CrudCreator\Providers\CrudCreatorServiceProvider",
            '--tag'      => "crud-creator-config",
            '--force'    => true
        ]);
    }

    private function publishStubs()
    {
        $this->call('vendor:publish', [
            '--provider' => "Miladimos\CrudCreator\Providers\CrudCreatorServiceProvider",
            '--tag'      => "crud-creator-stubs",
            '--force'    => true
        ]);
    }
}
