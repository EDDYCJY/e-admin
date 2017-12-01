<?php

namespace Eadmin\Kernel\Support;

use yii\helpers\ArrayHelper;
use backend\models\Upload;
use Eadmin\Kernel\Support\Container;
use Eadmin\Entity\UploadEntity;
use Eadmin\Config;
use Eadmin\Constants;

/**
 * Class Helpers
 * @package Eadmin\Kernel\Support
 */
class Helpers
{
    /**
     * Get DemoTest to Demo_Test
     *
     * @param  string $value
     * @return string
     */
    public static function getUnderscore($value)
    {
        return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $value), "_"));
    }

    /**
     * Get DemoTest to Demo-Test
     *
     * @param  string $value
     * @return string
     */
    public static function getUnderline($value)
    {
        return strtolower(trim(preg_replace("/[A-Z]/", "-\\0", $value), "-"));
    }

    public static function getCamelize($value)
    {
        $value = preg_replace_callback('/([-_]+([a-z]{1}))/i',function($matches){
            return strtoupper($matches[2]);
        },$value);

        return ucfirst($value);
    }

    /**
     * Get Select Data Map
     *
     * @param  array  $values
     * @param  string $index
     * @param  string $field
     * @return array
     */
    public static function getSelectMap($values, $index, $field)
    {
        return ArrayHelper::getColumn(ArrayHelper::index($values, $index), $field);
    }

    /**
     * Get Array End data
     *
     * @param  $value
     * @return mixed
     */
    public static function getLastIndex($value)
    {
        $name = explode('\\', $value);
        return end($name);
    }

    /**
     * Get Full Image Path
     *
     * @param  mixed $paths
     * @return array
     */
    public static function getFullImagePaths($paths)
    {
        if(! is_array($paths)) {
            $paths  = explode(',', $paths);
        }
       
        $result = [];
        foreach ($paths as $index => $id) {
            $result[] = UploadEntity::getFullUrl($id);
        }

        return $result;
    }
}