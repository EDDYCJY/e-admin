<?php
namespace Eadmin;

use Eadmin\Config;
use Eadmin\Kernel\Factory\GenFactory;
use Eadmin\Kernel\Factory\ExecuteFactory;
use Eadmin\Kernel\Factory\PublishFactory;
use Eadmin\Kernel\Factory\ExtraFactory;

/**
 * Class Gen
 * @package Eadmin
 */
class Gen
{
	public static function init()
	{
		$factory = new PublishFactory();
		$commands = [
			'Adminlte',
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

		$configs = Config::get('App', 'eadmin_generator_enable');
		foreach ($commands as $value) {
			if(in_array(lcfirst($value), $configs) && $configs[lcfirst($value)] === true) {
				$execute->start($value, $factory->start($value));
			}
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