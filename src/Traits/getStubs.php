<?php

namespace Miladimos\CrudCreator\Traits;

trait getStubs
{
    private $vendor = 'vendor/miladimos/crud-creator';

    protected function getApiControllerStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/apiController.stub"));
    }

    protected function getApiRequestControllerStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/apiControllerRequest.stub"));
    }

    protected function getApiResourceControllerStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/apiControllerResource.stub"));
    }

    protected function getWebControllerStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/webController.stub"));
    }

    protected function getWebControllerRequestStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/webController.stub"));
    }

    protected function getResourceStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/resource.stub"));
    }

    protected function getResourceCollectionStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/resourceCollection.stub"));
    }

    protected function getRequestStub()
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/request.stub"));
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path("{$this->vendor}/stubs/$type.stub"));
    }

    public function stubPath()
    {
        return __DIR__ . '/stubs';
    }
}
