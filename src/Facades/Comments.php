<?php

namespace Fawad\Comments\Facades;

use Illuminate\Support\Facades\Facade;

class Comments extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'comments'; // bound in ServiceProvider
    }
}
