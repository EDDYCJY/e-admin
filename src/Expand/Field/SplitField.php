<?php

namespace Eadmin\Expand\Field;

use Eadmin\Expand\Field\BaseField;
use Eadmin\Kernel\Support\Container;
use Eadmin\Config;

/**
 * Class SplitField
 * @package Eadmin\Expand\Field
 */
class SplitField extends BaseField
{
    /**
     * @return array
     */
	public function start($tableName, $fieldTypeName)
	{
		$result = [];
        $container = Container::make($tableName);
        $presets   = Config::get('App', 'eadmin_split_fields');
        foreach ($container['modelParams'] as $fieldName => $value) {
            foreach ($presets as $presetsName) {
                if($presetsName == $fieldName) {
                    $result[] = $fieldName;
                }
            }
        }

        return $result;
	}
}