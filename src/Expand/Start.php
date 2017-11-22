<?php

namespace Eadmin\Expand;

use Eadmin\Config;

class Start
{
	public static function view($attribute, $container)
	{
		$configs = Config::get('App', 'eadmin_list_fields');
		if(array_key_exists($attribute, $configs)) {
			$namespace = $configs[$attribute];

			return trim($namespace::column($attribute, $container), "'");
		}

		return "'" . $attribute . "'";
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