<?php

namespace Seleznev\Beep;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * This is the Beep facade class.
 */
class Facade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'beep';
    }
}
