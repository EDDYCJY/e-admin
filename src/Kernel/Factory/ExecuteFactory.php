<?php

namespace Eadmin\Kernel\Factory;

use Yii;
use Eadmin\Basic\Execute;

class ExecuteFactory extends Execute
{
	public function start($namespace, $response)
	{
		$factory = "Eadmin\\Kernel\\Execute\\{$namespace}";
		$object  = new $factory($this->objecter);

		return $object->start($response);
	}
}