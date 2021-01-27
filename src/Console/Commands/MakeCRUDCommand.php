<?php

namespace Miladimos\CrudCreator\Console\Commands;


use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Miladimos\CrudCreator\CrudCreator;

class MakeCRUDCommand extends Command
{

    protected $signature = "make:crud
                           { model : Model Name }
                           {--a|api : Create a new CRUD Api Controller}
                           {--w|web : Create a new CRUD Web Controller}
                           {--r|resource : Create a new Resource file for Api Controllers}
                           ";

    protected $name = 'CrudCreator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new CRUD controller class';


    public function handle()
    {
        $modelName = trim(Str::studly($this->argument('model')));

        $this->warn("CRUD Controller for Model: {$modelName} is creating ...");

        die;
        try {
            if (CrudCreator::make($modelName))
                $this->info("CRUD Controller for Model: {$modelName} is created successfully.");
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
