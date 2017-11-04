<?php

namespace Eadmin\Kernel\Factory;

use Yii;
use Eadmin\Basic\Lock;

class ExecuteFactory
{
	public $objecter;

	public function __construct($object)
	{
		$this->objecter = $object;
	}

	public function start($namespace, $response)
	{
		$factory = "Eadmin\\Kernel\\Execute\\{$namespace}";
		$object  = new $factory($this->objecter, new Lock($namespace));

		return $object->start($response);
	}
}