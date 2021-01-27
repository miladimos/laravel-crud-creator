<?php

namespace Miladimos\CrudCreator\Traits;

use Illuminate\Support\Str;

trait helpersMethods
{

    protected function getApiControllerDefaultNamespace()
    {
        $apiControllerNamespace = config('crud-cretor.api.api_namespace') ?? 'Api';
        $apiVersion = config('crud-cretor.api.api_version') ?? 'v1';
        return app_path($apiControllerNamespace);
    }

    protected function getControllerDefaultNamespace()
    {
        $repositoryNamespace = config('crud-creator.web.web_namespace') ?? 'Site';
        return app_path($repositoryNamespace);
    }

    protected static function getModelNamespace($model)
    {
        $appNamespace = config('crud-creator.base_app_namespace') ?? 'App';
        $modelNamespace = config('crud-creator.models_namespace') ?? 'Models';

        return $appNamespace . '\\' . $modelNamespace . '\\' . $model . ';';
    }

    protected static function getResourceNamespace($model)
    {
        $appNamespace = config('crud-creator.base_app_namespace') ?? 'App';
        $resouceNamespace = config('crud-creator.models_namespace') ?? 'Models';

        return $appNamespace . '\\' . $resouceNamespace . '\\' . $model . ';';
    }

    protected static function getRequestNamespace($model)
    {
        $appNamespace = config('crud-creator.base_app_namespace') ?? 'App';
        $resouceNamespace = config('crud-creator.models_namespace') ?? 'Models';

        return $appNamespace . '\\' . $resouceNamespace . '\\' . $model . ';';
    }

    protected static function getRepositorySuffix($model)
    {
        $repotisorySuffix = config('crud.repositories_suffix') ?? 'Repository';
        return $model . $repotisorySuffix;
    }

    protected static function getModelClassName($model)
    {
        return Str::studly($model);
    }
}
