<?php

namespace Eadmin\Kernel\Factory;

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
		if(class_exists($namespace)) {
			$object = new $namespace($this->container, $attribute);
			return $object->start();
		}

		return null;
	}
}