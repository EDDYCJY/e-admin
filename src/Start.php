<?php
namespace Eadmin;

use Eadmin\Gen;
use Eadmin\Config;
use Eadmin\Basic\Model;

use Eadmin\Work\Model\AdminMenu;
use Eadmin\Work\Model\Article;
use Eadmin\Work\Model\AdminUser;
use Eadmin\Work\Model\Upload;

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
}