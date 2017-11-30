<?php

namespace Eadmin\Expand;

use Eadmin\Config;
use Eadmin\Expand\View\RelationField;

/**
 * Class Start
 * @package Eadmin\Expand
 */
class Start
{
    /**
     * Get GridView View
     *
     * @param  string $attribute field attribute
     * @param  array  $container model container
     * @return string
     */
	public static function view($attribute, $container)
	{
		$result = "'" . $attribute . "'";
		
		$class = $container['modelParams'][$attribute]['type'];
		$namespace = '\\Eadmin\\Expand\\View\\' . $class;
		if(class_exists($namespace)) {
			$result = trim($namespace::column($attribute, $container), "'");
		} else if(! empty($container['modelParams'][$attribute]['relations'])) {
			$result = RelationField::column($attribute, $container);
		}

		return $result;
	}

    /**
     * Get Field Items
     *
     * @param  string $tableName     table_name
     * @param  string $fieldTypeName field type_name
     * @return array
     */
	public static function field($tableName, $fieldTypeName)
	{
		$namespace = 'Eadmin\\Expand\\Field';
		$className = $namespace . '\\' . ucfirst($fieldTypeName);

		$result = [];
		if(class_exists($className)) {
			$object = new $className;
			$result = $object->start($tableName, $fieldTypeName);
		}
		
		return $result;
	}

	/**
	 * Get Export Items
	 * 
     * @param  string $tableName     table_name
     * @return array
	 */
	public static function export($fieldTypeName)
	{
		$namespace = 'Eadmin\\Expand\\Export';
		$className = $namespace . '\\' . ucfirst($fieldTypeName);

		$result = '';
		if(class_exists($className)) {
			$object = new $className;
			$result = $object->start();
		}

		return $result;
	}

}