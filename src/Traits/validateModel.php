<?php namespace Miladimos\CrudCreator\Traits;

use InvalidArgumentException;


trait validateModel
{

    protected function ensureControllerDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getControllerNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
    }

    protected function ensureApiControllerDoesntAlreadytExist($model) {
        if (class_exists($classFullyQualified = $this->getApiControllerDefaultNamespace($model), false)) {
          throw new InvalidArgumentException("{$classFullyQualified} already exists.");
        }
    }

}
