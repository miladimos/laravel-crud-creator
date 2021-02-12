<?php

namespace Miladimos\CrudCreator\Traits;

trait GetStubs
{
    private $ds = DIRECTORY_SEPARATOR;

    private $vendor = "vendor\miladimos\crud-creator";

    protected function getApiControllerStub()
    {
        return file_get_contents($this->stubPath() . "apiController.stub");
    }

    protected function getApiRequestControllerStub()
    {
        return file_get_contents($this->stubPath() . "apiControllerRequest.stub");
    }

    protected function getApiResourceControllerStub()
    {
        return file_get_contents($this->stubPath() . "apiControllerResource.stub");
    }

    protected function getWebControllerStub()
    {
        return file_get_contents($this->stubPath() . "webController.stub");
    }

    protected function getWebControllerRequestStub()
    {
        return file_get_contents($this->stubPath() . "webController.stub");
    }

    protected function getResourceStub()
    {
        return file_get_contents($this->stubPath() . "resource.stub");
    }

    protected function getResourceCollectionStub()
    {
        return file_get_contents($this->stubPath() . "resourceCollection.stub");
    }

    protected function getRequestStub()
    {
        return file_get_contents($this->stubPath() . "request.stub");
    }

    protected function getStub($type)
    {
        return file_get_contents($this->stubPath() . "$type.stub");
    }

    public function stubPath()
    {
        return resource_path("{$this->vendor}\stubs\\");
    }
}
