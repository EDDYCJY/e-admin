<?php

namespace Eadmin\Kernel\Support;

class Helpers
{
    public static function getUnderscore($value)
    {
        return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $value), "_"));
    }

    public static function getUnderline($value)
    {
        return strtolower(trim(preg_replace("/[A-Z]/", "-\\0", $value), "-"));
    }

    public static function getLastIndex($value)
    {
        $name = explode('\\', $value);
        return end($name);
    }

}