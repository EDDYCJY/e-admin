<?php
namespace Eadmin;

use Yii;
use Exception;
use Eadmin\Gen;
use Eadmin\Config;
use Eadmin\Command\Flush;
use Eadmin\Command\Delete;

/**
 * Class Start
 * @package Eadmin
 */
class Start
{
	public static function init($modelClass = [])
	{
		Config::init();

		Gen::init();

		$autoloadClass = Config::get('Autoload', 'models');
		$genClass = array_merge($autoloadClass, $modelClass);

		foreach ($genClass as $class) {
			if(class_exists($class)) {
				Gen::start(new $class);
			}
		}
		
        Gen::extra();
	}

	public static function flush()
	{
		Config::init();

		$object = new Flush();
		$object->table();
		$object->runtime();

		echo $object->getSuccessMsg();
		echo $object->getErrorMsg();
		
		$object->close();
	}

	public static function delete($params)
	{
		Config::init();

		$object = new Delete($params);
		$result = $object->start();
		if($result === null) {
			echo $object->getNotFoundMsg();
		} else if($result === true) {
			echo $object->getSuccessMsg();
		} else {
			echo $object->getErrorMsg();
		}

		$object->close();
	}

}