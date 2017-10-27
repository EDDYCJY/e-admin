<?php

namespace Eadmin\Kernel\Factory;

use Yii;
use Eadmin\Basic\Gen;

class GenFactory extends Gen 
{
	public function start($namespace)
	{
		$factory = "Eadmin\\Kernel\\Gen\\{$namespace}";
		$object  = new $factory;

		return $object->start($this->tabler);
	}
}