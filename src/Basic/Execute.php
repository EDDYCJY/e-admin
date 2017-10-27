<?php

namespace Eadmin\Basic;

class Execute 
{
	//解析对象
	public $objecter;
	
	public function __construct($object)
	{
		$this->objecter = $object;
	}
}