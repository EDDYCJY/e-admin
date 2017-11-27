<?php

namespace Eadmin\Expand;

use Eadmin\Config;
use Eadmin\Expand\View\RelationField;

class Start
{
	public static function view($attribute, $container)
	{
		$configs = Config::get('App', 'eadmin_list_fields');

		$result = "'" . $attribute . "'";
		if(array_key_exists($attribute, $configs)) {
			$namespace = $configs[$attribute];

			$result = trim($namespace::column($attribute, $container), "'");
		} else if(! empty($container['modelParams'][$attribute]['relations'])) {
			$result = RelationField::column($attribute, $container);
		}

		return $result;
	}

	public static function field($fullTableName, $fieldTypeName)
	{
		$namespace = 'Eadmin\\Expand\\Field';
		$className = $namespace . '\\' . ucfirst($fieldTypeName);

		$result = [];
		if(class_exists($className)) {
			$object = new $className;
			$result = $object->start($fullTableName, $fieldTypeName);
		}
		
		return $result;
	}

}