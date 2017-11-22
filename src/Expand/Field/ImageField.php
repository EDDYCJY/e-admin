<?php

namespace Eadmin\Expand\Field;

use Eadmin\Constants;
use Eadmin\Expand\Field\BaseField;
use Eadmin\Kernel\Support\Container;

class ImageField extends BaseField
{
	public function start($fullTableName, $fieldTypeName)
	{
		$result = [];
        $container = Container::make($fullTableName);
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