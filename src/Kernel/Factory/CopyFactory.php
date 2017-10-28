<?php

namespace Eadmin\Kernel\Factory;

class CopyFactory
{
	public function start($namespace)
	{
		$factory = "Eadmin\\Kernel\\Copy\\{$namespace}";
		$object  = new $factory();

		return $object->start();
	}
}