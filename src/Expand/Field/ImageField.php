<?php

namespace Eadmin\Expand\Field;

use Eadmin\Constants;
use Eadmin\Expand\Field\BaseField;
use Eadmin\Kernel\Support\Container;

/**
 * Class ImageField
 * @package Eadmin\Expand\Field
 */
class ImageField extends BaseField
{
    /**
     * @return array
     */
	public function start($tableName, $fieldTypeName)
	{
		$result = [];
        $container = Container::make($tableName);
        foreach ($container['modelParams'] as $key => $value) {
            if($value['type'] == Constants::IMAGE_FIELD) {
                $result[$key] = 1;
            } else if($value['type'] == Constants::IMAGES_FIELD) {
                $result[$key] = 2;
            }
        }

        return $result;
	}
}