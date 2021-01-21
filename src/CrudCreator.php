<?php


namespace Miladimos\CrudCreator;


use Miladimos\CrudCreator\Traits\getStubs;
use Miladimos\CrudCreator\Traits\validateModel;
use Miladimos\CrudCreator\Traits\helpersMethods;

class CrudCreator
{
    use getStubs, helpersMethods, validateModel;


    protected static function createProvider()
    {
        $template =  self::getCrudCreatorServiceProviderStub();

        if (!file_exists($path=base_path('/App/Providers/CrudCreatorServiceProvider.php')))
            file_put_contents(base_path('/App/Providers/CrudCreatorServiceProvider.php'), $template);
    }


    protected static function createCrudCreator($name)
    {
        $modelNamespace = self::getModelNamespace($name);
        $interfaceNamespace = self::getInterfaceNamespace($name);
        $template = str_replace(
            ['{{$modelName}}', '{{ $modelNamespace }}'],
            [$name, $modelNamespace],
            self::getCrudCreatorStub()
        );


        file_put_contents(base_path("/App/Repositories/{$name}CrudCreator.php"), $template);
    }

    protected static function createInterface($name)
    {
        $interfaceNamespace = self::getInterfaceNamespace($name);
        $template = str_replace(
            ['{{ $interfaceNamespace }}'],
            [$$interfaceNamespace],
            self::getCrudCreatorInterfaceStub()
        );

        file_put_contents(base_path("/Repositories/{$name}EloquentCrudCreatorInterface.php"), $template);

    }

    public static function make($modelName)
    {

        if (!file_exists($path=(new self)->getCrudCreatorDefaultNamespace()))
            mkdir($path, 0777, true);

        // self::createProvider();
        self::createCrudCreator($modelName);
        self::createInterface($modelName);

        return true;
    }
}
