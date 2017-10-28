<?php
namespace Eadmin;

use Eadmin\Kernel\Factory\GenFactory;
use Eadmin\Kernel\Factory\ExecuteFactory;

class Gen
{
	public static function init()
	{
		
	}

	public static function start($object)
	{
		$factory  = new GenFactory($object);
		$execute  = new ExecuteFactory($factory);
		$commands = [
			'Table',
			'Model',
			'Crud',
			'Menu',
			'Setting',
		];

		foreach ($commands as $value) {
			$execute->start($value, $factory->start($value));
		}

		return true;
	}
}