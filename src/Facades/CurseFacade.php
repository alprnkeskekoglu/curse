<?php

namespace Curse\Facades;

use \Illuminate\Support\Facades\Facade;

class CurseFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Curse';
    }
}
