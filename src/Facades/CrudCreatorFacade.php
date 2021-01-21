<?php

namespace Miladimos\CrudCreator\Facades;

use Illuminate\Support\Facades\Facade;

class CrudCreatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'repository';
    }
}
