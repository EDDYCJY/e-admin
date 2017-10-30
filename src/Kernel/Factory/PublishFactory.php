<?php

namespace Eadmin\Kernel\Factory;

use Eadmin\Kernel\Copy\File;
use Eadmin\Kernel\Copy\Catalog;

class PublishFactory
{
	public function start($namespace)
	{
		$factory = "Eadmin\\Kernel\\Publish\\{$namespace}";
		$object  = new $factory();

		$from = $object->getFrom();
		$to   = $object->getTo();

		return $object->start(new File($from, $to), new Catalog($from, $to));
	}
}