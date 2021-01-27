<?php


namespace Miladimos\CrudCreator;

use Miladimos\CrudCreator\Traits\getStubs;
use Miladimos\CrudCreator\Traits\validateModel;
use Miladimos\CrudCreator\Traits\helperMethods;

class CrudCreator
{
    use getStubs, helperMethods, validateModel;

    public static function createApiCrud($modelName)
    {
        $apiContollerNamespace = (new static)->getApiControllerDefaultNamespace();
        $modelNamespace = (new static)->getModelNamespace($modelName);
        // dd($apiContollerNamespace);
        $template = str_replace(
            ['{{ $modelName }}', '{{ $apiControllerNamespace }}'],
            [$name, $apiContollerNamespace],
            (new static)->getApiControllerStub($name)
        );


        if (!file_exists($path=base_path('/App/Providers/CrudCreatorServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/CrudCreatorServiceProvider.php'), $template);

        file_put_contents(base_path("/App/Repositories/{$name}CrudCreator.php"), $template);
    }

}
