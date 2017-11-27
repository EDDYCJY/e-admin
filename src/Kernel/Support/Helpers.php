<?php

namespace Eadmin\Kernel\Support;

use yii\helpers\ArrayHelper;
use backend\models\Upload;
use Eadmin\Kernel\Support\Container;
use Eadmin\Entity\UploadEntity;
use Eadmin\Config;
use Eadmin\Constants;

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

    public static function getSelectMap($values, $index, $field)
    {
        return ArrayHelper::getColumn(ArrayHelper::index($values, $index), $field);
    }

    public static function getLastIndex($value)
    {
        $name = explode('\\', $value);
        return end($name);
    }

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