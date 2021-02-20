<?php

namespace Miladimos\CrudCreator\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Miladimos\CrudCreator\CrudCreator;
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

        // if ((new self)->ensureRepositoryDoesntAlreadytExist($this->modelName)) {
        //     $msg = (new self)->getRepositoryFilePath($this->modelName) . " already exist. you must overwrite it! Are you ok?";

        //     $confirm = $this->confirm($msg);
        //     if ($confirm) {
        //         if (CrudCreator::makeRepository($this->modelName)) {
        //             $this->info("$this->modelName.php overwrite finished");
        //             die;
        //         } else {
        //             $this->error('Error in overwriting Repository!');
        //             die;
        //         }
        //     } else {
        //         $this->modelName = $this->ask("Enter the Repository file name? ");
        //     }
        // }

        try {

            if (CrudCreator::createWebCrud($model))
                $this->info("CRUD Web Controller for Model: {$model} is created successfully.");
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
                $this->info("CRUD Api Controller for Model: {$model} is created successfully.");
            else
                $this->error('Error in Creating CRUD Controller for!');
            die;
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            die;
        }
    }

}
