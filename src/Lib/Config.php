<?php

namespace App\Lib;

/**
 * Class serving as wrapper for application configuration
 */
class Config
{

    /**
     * @var array
     */
    private static $config;

    /**
     * Get Item from Configuration array
     * @param string $key index in array
     * @param string $default value in the event key was not found
     * @return string
     */
    public static function get(string $key, string $default = '') : string
    {
        if (is_null(self::$config)) {
            self::$config = require_once(__DIR__.'/../../config/app.php');
        }
        return !empty(self::$config[$key]) ? self::$config[$key] : $default;
    }

}