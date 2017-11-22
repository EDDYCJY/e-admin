<?php
namespace Eadmin;

use Yii;
use Exception;
use Eadmin\Gen;
use Eadmin\Config;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\FileLock;
use Eadmin\Command\Flush;

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

	public static function flush($modelClass = [])
	{
		Config::init();

		$flush = new Flush();
		$flush->table();
		$flush->runtime();

		echo '[Success]: ' . "\n\n";
		echo implode("\n", $flush->getSuccess()) . "\n\n";
		echo '[Error]: ' . "\n\n";
		echo implode("\n", $flush->getError()) . "\n\n";
		die;
	}

}