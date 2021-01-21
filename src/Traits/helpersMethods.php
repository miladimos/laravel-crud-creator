<?php

namespace Miladimos\CrudCreator\Traits;

use Illuminate\Support\Str;


trait helpersMethods
{

    protected function getApiControllerDefaultNamespace()
    {
        $repositoryNamespace = config('crud.repositories_namespace') ?? 'Api';
        return app_path($repositoryNamespace);
    }


    /**
     * Get the repository's class name.
     *
     * @param string $model
     * @return string
     */
    protected static function getRepositorySuffix($model)
    {
        $repotisorySuffix = config('crud.repositories_suffix') ?? 'Repository';
        return $model . $repotisorySuffix;
    }

    /**
     * Get the class name of the model name.
     *
     * @param string $model
     * @return string
     */
    protected static function getModelClassName($model)
    {
        return Str::studly($model);
    }

    protected static function getModelNamespace($model)
    {
        $appNamespace = config('crud.base_app_namespace') ?? 'App';
        $modelNamespace = config('crud.models_namespace') ?? 'Models';

        return $appNamespace . '\\' . $modelNamespace . '\\' . $model . ';';
    }

    protected static function getInterfaceNamespace($model)
    {
        $appNamespace = config('crud.base_app_namespace') ?? 'App';
        $modelNamespace = config('crud.models_namespace') ?? 'Models';

        return $appNamespace . '\\' . $modelNamespace . '\\' . $model . ';';
    }



}
