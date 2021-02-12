<?php

namespace Miladimos\CrudCreator\Console\Commands;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Miladimos\CrudCreator\CrudCreator;
use Symfony\Component\Finder\SplFileInfo;
use Miladimos\CrudCreator\Traits\HelperMethods;

class MakeCRUDCommand extends Command
{
    use HelperMethods;

    protected $signature = "make:crud
                           { model : Model Name }
                           {--a|api : Create a new CRUD Api Controller}
                           {--w|web : Create a new CRUD Web Controller}
                           {--r|resource : Create a new Resource file for Api Controllers}
                           {--rq|request : Create a new Request file for Controllers}
                           ";

    protected $name = 'crud-creator';

    protected $description = 'Create a new CRUD controller class';

    protected $modelName;


    public function handle()
    {
        $this->modelName = $this->getModelClassName($this->argument('model'));

        $this->warn("CRUD Controller for Model: {$this->modelName} is creating ...");

        if($this->option('web')) {
            $this->createWebCrud($this->modelName);
        }

        if($this->option('api')) {
            $this->createApiCrud($this->modelName);
        }


        return 0;
    }


    protected function createWebCrud($model)
    {
        try {

            if (CrudCreator::createWebCrud($model))
                $this->info("CRUD Controller for Model: {$model} is created successfully.");
            else
                $this->error('Error in Creating CRUD Controller for!');
            die;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            die;
        }
    }

    protected function createApiCrud($model)
    {
        try {

            if (CrudCreator::createApiCrud($model))
                $this->info("CRUD Controller for Model: {$model} is created successfully.");
            else
                $this->error('Error in Creating CRUD Controller for!');
            die;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            die;
        }
    }

}
