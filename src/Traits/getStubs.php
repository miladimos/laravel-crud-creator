<?php

namespace Miladimos\CrudCreator\Traits;


trait getStubs
{

    protected static function getApiControllerStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/crud-creator/stubs/apiController.stub"));
    }

    protected static function getWebControllerStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/crud-creator/stubs/webController.stub"));
    }

    protected static function getResourceStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/crud-creator/stubs/resource.stub"));
    }

    protected static function getRequestStub()
    {
        return file_get_contents(resource_path("vendor/miladimos/crud-creator/stubs/request.stub"));
    }

    protected static function getStub($type)
    {
        return file_get_contents(resource_path("vendor/miladimos/crud-creator/stubs/$type.stub"));
    }

    public function stubPath()
    {
        return __DIR__ . '/stubs';
    }
}
