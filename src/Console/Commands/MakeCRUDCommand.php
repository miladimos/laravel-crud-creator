<?php

namespace Miladimos\CrudCreator\Console\Commands;


use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Miladimos\CrudCreator\CrudCreator;

class MakeCRUDCommand extends Command
{

    protected $signature = "make:crud
                           { model : Model Name }";

    protected $name = 'CrudCreator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make New CrudCreator';


    public function handle()
    {
        $modelName = trim(Str::studly($this->argument('model')));

        $this->warn("CrudCreator {$modelName} is creating ...");

        try {
            if(CrudCreator::make($modelName))
                $this->info("CrudCreator Model: {$modelName} is created successfully.");
            else
                $this->error('Error in Creating CrudCreator!');
                die;
        }catch (\Exception $exception) {
            $this->error($exception);
            die;
        }

        return 0;
    }

}
