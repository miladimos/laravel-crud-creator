<?php

namespace Miladimos\CrudCreator\Traits;

use Illuminate\Support\Str;

trait HelperMethods
{

    protected function getApiControllerDefaultNamespace()
    {
        $appNamespace = config('crud-creator.base_app_namespace') ?? 'App';
        $apiControllerNamespace = config('crud-cretor.api.namespace') ?? 'Api';
        $apiVersion = config('crud-cretor.api.api_version') ?? 'v1';
        return $appNamespace . '\\' . "Http\\Controllers" . '\\' . $apiControllerNamespace . "\\" .  $apiVersion . ';';
    }

    protected function getWebControllerDefaultNamespace()
    {
        $appNamespace = config('crud-creator.base_app_namespace') ?? 'App';
        $webControllerNamespace = config('crud-cretor.web.namespace') ?? 'Site';
        return $appNamespace . '\\' . "Http\\Controllers" . '\\' . $webControllerNamespace . ';';
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
        return Str::studly(trim($model));
    }
}
