<?php

namespace Eadmin\Kernel\Support;

use backend\models\Upload;
use Eadmin\Kernel\Support\Container;

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
        
        $prefix = Config::get('Setting', 'image_url_prefix');
        
        $result = [];
        foreach ($paths as $key => $value) {
            $result[] = $prefix . Upload::find()->where(['id' => $value])->select('url')->scalar();
        }

        return $result;
    }

    public static function getImageFields($fullName)
    {
        $result = [];
        $container = Container::make($fullName);
        foreach ($container['modelParams'] as $key => $value) {
            if($value['type'] == Constants::IMAGE_FIELD) {
                $result[$key] = 1;
            } else if($value['type'] == Constants::IMAGES_FIELD) {
                $result[$key] = 2;
            }
        }

        return $result;
    }

    public static function getTimeFields($fullName)
    {
        $result = [];
        $container = Container::make($fullName);
        foreach ($container['modelParams'] as $name => $value) {
            if($value['type'] == Constants::TIME_FIELD) {
                $result[] = $name;
            } 
        }

        return $result;
    }

    public static function getStateFields($fullName)
    {
        $result = [];
        $container = Container::make($fullName);
        foreach ($container['modelParams'] as $name => $value) {
            if($value['type'] == Constants::STATE_FIELD) {
                $result[] = $name;
            } 
        }

        return $result;
    }

    public static function getSplitFields($fullName)
    {
        $result = [];
        $container = Container::make($fullName);
        $presets   = Config::get('App', 'eadmin_split_fields');

        foreach ($container['modelParams'] as $name => $value) {
            foreach ($presets as $index => $type) {
                if($type == $value['type']) {
                    $result[] = $name;
                }
            }
        }

        return $result;
    }

    public static function convertArrayToStr($array)
    {
        $str = '';
        foreach ($array as $key => $params) {
            if(isset($params['separator']) && isset($params['value'])) {
                $str .= "'" . $key . "'" . ' => ' . $params['separator'] . $params['value'] . $params['separator'] . ',';
            } else {
                $prefix = "'" . $key ;
                $arrow  = "'" . ' => ' . "'";
                $suffix = "'" . ',';

                $str .= $prefix . $arrow .$params . $suffix;
            }
        }

        return trim($str, ',');
    }

}