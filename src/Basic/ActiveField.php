<?php

namespace Eadmin\Basic;

class ActiveField
{
	protected $container;

	protected $attribute;

	public function __construct($container, $attribute)
	{
		$this->container = $container;
		
		$this->attribute = $attribute;

		$this->init();
	}

	public function init()
	{}

}