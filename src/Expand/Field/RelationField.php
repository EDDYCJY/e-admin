<?php

namespace Eadmin\Expand\Field;

use Eadmin\Kernel\Support\Container;
use Eadmin\Expand\Field\BaseField;

/**
 * Class RelationField
 * @package Eadmin\Expand\Field
 */
class RelationField extends BaseField
{
    /**
     * @return array
     */
	public function start($tableName, $fieldTypeName)
	{
		$result = [];
        $container = Container::make($tableName);
        foreach ($container['modelParams'] as $key => $value) {
            if(! empty($value['relations'])) {
                $result[] = $key;
            }
        }

        return $result;
	}
}