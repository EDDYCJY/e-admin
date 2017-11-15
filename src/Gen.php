<?php
namespace Eadmin;

use Eadmin\Kernel\Factory\GenFactory;
use Eadmin\Kernel\Factory\ExecuteFactory;
use Eadmin\Kernel\Factory\PublishFactory;
use Eadmin\Kernel\Factory\ExtraFactory;

class Gen
{
	public static function init()
	{
		$factory = new PublishFactory();
		$commands = [
			//'Adminlte',
			'Asset',
			'Controller',
			'View',
			'Model',
			'Widget',
		];

		foreach ($commands as $value) {
			$factory->start($value);
		}
		
		return true;
	}
	
	public static function start($object)
	{
		$factory  = new GenFactory($object);
		$execute  = new ExecuteFactory($factory);
		$commands = [
			'Table',
			'Model',
			'Menu',
			'Crud',
		];

		foreach ($commands as $value) {
			$execute->start($value, $factory->start($value));
		}

		return true;
	}

	public static function extra()
	{
		$object = new ExtraFactory();
		$commands = [
			'Admin',
		];

		foreach ($commands as $value) {
			$object->start($value);
		}

		return true;
	}

}