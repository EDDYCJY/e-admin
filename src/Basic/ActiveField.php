<?php

namespace Eadmin\Basic;

/**
 * Class ActiveField
 * @package Eadmin\Basic
 */
class ActiveField
{
    /**
     * @var array
     */
	protected $container;

    /**
     * @var string
     */
	protected $attribute;

    /**
     * ActiveField constructor.
     *
     * @param  array  $container model container
     * @param  string $attribute model attribute
     * @return null
     */
	public function __construct($container, $attribute)
	{
		$this->container = $container;
		
		$this->attribute = $attribute;

		$this->init();
	}

	public function init()
	{}

}