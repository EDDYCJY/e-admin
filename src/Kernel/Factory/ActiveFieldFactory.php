<?php

namespace Eadmin\Kernel\Factory;

use Eadmin\Kernel\ActiveField\RelationField;

/**
 * Class ActiveFieldFactory
 * @package Eadmin\Kernel\Factory
 */
class ActiveFieldFactory
{	
	public $container;

	public $className;

	public function __construct($container, $className)
	{
		$this->container = $container;

		$this->className = $className;
	}

	public function start($attribute)
	{
		$namespace = 'Eadmin\\Kernel\\ActiveField\\' . ucfirst($this->className);

		$result = null;
		if(class_exists($namespace)) {
			$object = new $namespace($this->container, $attribute);
			$result = $object->start();
		} else if(! empty($this->container['modelParams'][$attribute]['relations'])) {
			$object = new RelationField($this->container, $attribute);
			$result = $object->start();
		}

		return $result;
	}
}