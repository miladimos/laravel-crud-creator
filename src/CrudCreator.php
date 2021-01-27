<?php


namespace Miladimos\CrudCreator;

use Miladimos\CrudCreator\Traits\getStubs;
use Miladimos\CrudCreator\Traits\validateModel;
use Miladimos\CrudCreator\Traits\helpersMethods;

class CrudCreator
{
    use getStubs, helpersMethods, validateModel;

    protected static function createApiCrud($name)
    {
        $modelNamespace = (new static)->getApiControllerDefaultNamespace($name);
        $template = str_replace(
            ['{{$modelName}}', '{{ $modelNamespace }}'],
            [$name, $modelNamespace],
            (new static)->getApiControllerStub($name)
        );


        if (!file_exists($path=base_path('/App/Providers/CrudCreatorServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/CrudCreatorServiceProvider.php'), $template);

        file_put_contents(base_path("/App/Repositories/{$name}CrudCreator.php"), $template);
    }

    public static function make($modelName)
    {

        if (!file_exists($path=(new static)->getCrudCreatorDefaultNamespace()))
            mkdir($path, 0777, true);

        // self::createProvider();
        self::createCrudCreator($modelName);
        self::createInterface($modelName);

        return true;
    }
}
