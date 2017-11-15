<?php

namespace Eadmin\Basic;

class Execute 
{
	public $objecter;

	public $locker;
	
	public function __construct($object, $locker)
	{
		$this->objecter = $object->gen;

		$this->locker = $locker;
	}
}