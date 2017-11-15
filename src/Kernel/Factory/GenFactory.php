<?php

namespace Eadmin\Kernel\Factory;

use Yii;
use Eadmin\Kernel\Support\Gen;

class GenFactory
{
	public $gen;

	public function __construct($object)
	{
		$this->gen = new Gen($object);
		$this->gen->bind();
	}

	public function start($namespace)
	{
		$factory = "Eadmin\\Kernel\\Gen\\{$namespace}";
		$object  = new $factory;

		return $object->start($this->gen->getTabler());
	}
}