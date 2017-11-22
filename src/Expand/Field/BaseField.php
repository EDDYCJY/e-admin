<?php

namespace Eadmin\Expand\Field;

use Eadmin\Kernel\Support\Container;

class BaseField
{
	public function start($fullTableName, $fieldTypeName)
	{
		$result = [];
        $container = Container::make($fullTableName);
        foreach ($container['modelParams'] as $name => $value) {
            if($value['type'] == $fieldTypeName) {
                $result[] = $name;
            } 
        }

        return $result;
	}
}