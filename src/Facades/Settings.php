<?php

namespace AniketIN\Settings\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AniketIN\Settings\Settings
 */
class Settings extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AniketIN\Settings\Settings::class;
    }
}
