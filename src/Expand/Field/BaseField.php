<?php

namespace Eadmin\Expand\Field;

use Eadmin\Kernel\Support\Container;

/**
 * Class BaseField
 * @package Eadmin\Expand\Field
 */
class BaseField
{
    /**
     * @return array
     */
	public function start($tableName, $fieldTypeName)
	{
		$result = [];
        $container = Container::make($tableName);
        foreach ($container['modelParams'] as $name => $value) {
            if($value['type'] == $fieldTypeName) {
                $result[] = $name;
            } 
        }

        return $result;
	}
}