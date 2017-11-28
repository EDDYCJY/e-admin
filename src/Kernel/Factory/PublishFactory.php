<?php

namespace Eadmin\Kernel\Factory;

use Eadmin\Kernel\Copy\File;
use Eadmin\Kernel\Copy\Catalog;
use Eadmin\Basic\Lock;

/**
 * Class PublishFactory
 * @package Eadmin\Kernel\Factory
 */
class PublishFactory
{
	public function start($namespace)
	{
		$factory = "Eadmin\\Kernel\\Publish\\{$namespace}";
		$object  = new $factory();

		$from = $object->getFrom();
		$to   = $object->getTo();

		return $object->start(new File($from, $to, new Lock($namespace)), new Catalog($from, $to, new Lock($namespace)));
	}
}