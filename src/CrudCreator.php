<?php

namespace Miladimos\CrudCreator;

use Illuminate\Support\Facades\File;
use Miladimos\CrudCreator\Traits\getStubs;
use Miladimos\CrudCreator\Traits\validateModel;
use Miladimos\CrudCreator\Traits\helperMethods;

class CrudCreator
{
    use getStubs,
        helperMethods,
        validateModel;

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
        $webControllerPath = (new static)->getWebControllerPath($modelName);
        $webControllerNamespace = (new static)->getWebControllerDefaultNamespace() . '\\' . $modelName;
        $modelNamespace = (new static)->getModelNamespace($modelName);
        $getWebControllerDirPath = (new static)->getWebControllerDirPath($modelName);

        $template = str_replace(
            ['{{ $modelName }}', '{{ $modelNamespace }}', '{{ $webControllerNamespace }}'],
            [$modelName, $modelNamespace, $webControllerNamespace],
            (new static)->getWebControllerStub($modelName)
        );

        if (!File::isDirectory($path = $getWebControllerDirPath))
            mkdir($path, 0777, true);

        if (!file_exists($webControllerPath))
            file_put_contents($webControllerPath, $template);
    }

    public static function make()
    {
        // dd((new static)->stubPath());
    }
}
