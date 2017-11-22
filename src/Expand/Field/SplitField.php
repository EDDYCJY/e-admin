<?php

namespace Eadmin\Expand\Field;

use Eadmin\Expand\Field\BaseField;
use Eadmin\Kernel\Support\Container;
use Eadmin\Config;

class SplitField extends BaseField
{
	public function start($fullTableName, $fieldTypeName)
	{
		$result = [];
        $container = Container::make($fullTableName);
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