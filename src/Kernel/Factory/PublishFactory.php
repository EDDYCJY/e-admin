<?php

namespace Eadmin\Kernel\Factory;

class PublishFactory
{
	public function start($namespace)
	{
		$factory = "Eadmin\\Kernel\\Publish\\{$namespace}";
		$object  = new $factory();

		return $object->start();
	}
}