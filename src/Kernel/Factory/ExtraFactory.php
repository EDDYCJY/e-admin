<?php

namespace Eadmin\Kernel\Factory;

use Eadmin\Basic\Lock;

/**
 * Class ExtraFactory
 * @package Eadmin\Kernel\Factory
 */
class ExtraFactory
{
	public function start($namespace)
	{
		$factory = "Eadmin\\Kernel\\Extra\\{$namespace}";
		$object  = new $factory(new Lock($namespace));

		return $object->start();
	}
}