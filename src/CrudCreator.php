<?php

namespace Miladimos\CrudCreator;

use Miladimos\CrudCreator\Traits\GetStubs;
use Miladimos\CrudCreator\Traits\ValidateModel;
use Miladimos\CrudCreator\Traits\HelperMethods;

class CrudCreator
{
    use GetStubs,
        HelperMethods,
        ValidateModel;

    public static function createApiCrud($modelName)
    {
        $apiContollerNamespace = (new static)->getApiControllerDefaultNamespace();
        $modelNamespace = (new static)->getModelNamespace($modelName);
        // dd($apiContollerNamespace);
        $template = str_replace(
            ['{{ $modelName }}', '{{ $modelNamespace }}', '{{ $apiControllerNamespace }}'],
            [$modelName, $modelNamespace, $apiContollerNamespace],
            (new static)->getApiControllerStub($modelName)
        );


        if (!file_exists($path = base_path('/App/Providers/CrudCreatorServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/CrudCreatorServiceProvider.php'), $template);

        file_put_contents(base_path("/App/Repositories/{$modelName}CrudCreator.php"), $template);
    }

    public static function createWebCrud($modelName)
    {
        $webContollerNamespace = (new static)->getWebControllerDefaultNamespace();
        $modelNamespace = (new static)->getModelNamespace($modelName);
        $template = str_replace(
            ['{{ $modelName }}', '{{ $modelNamespace }}', '{{ $webControllerNamespace }}'],
            [$modelName, $modelNamespace, $webContollerNamespace],
            (new static)->getWebControllerStub($modelName)
        );


        if (!file_exists($path = base_path('/App/Providers/CrudCreatorServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/CrudCreatorServiceProvider.php'), $template);

        file_put_contents(base_path("/App/Repositories/{$modelName}CrudCreator.php"), $template);
    }
}
