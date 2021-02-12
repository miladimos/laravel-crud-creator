<?php

namespace Miladimos\CrudCreator\Console\Commands;

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
                           ";

    protected $name = 'crud-creator';

    protected $description = 'Create a new CRUD controller class';

    protected $modelName;


    public function handle()
    {
        $this->modelName = $this->getModelClassName($this->argument('model'));

        $this->warn("CRUD Controller for Model: {$this->modelName} is creating ...");


        CrudCreator::make($this->modelName);

        die;

        try {

            if (CrudCreator::make($this->modelName))
                $this->info("CRUD Controller for Model: {$this->modelName} is created successfully.");
            else
                $this->error('Error in Creating CRUD Controller for!');
            die;
        } catch (\Exception $exception) {
            $this->error($exception);
            die;
        }

        return 0;
    }
}
