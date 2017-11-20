<?php
namespace Eadmin;

use Yii;
use Eadmin\Kernel\Gen\Setting;
use Eadmin\Kernel\Support\Gen;
use Eadmin\Config;

class Config
{
	const PATH = __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR;

	const EXT = '.php';

	const PREFIX = 'eadmin';

	public static function init()
	{
		self::bootstrap();

		self::load();

		self::bind();
	}

	public static function bootstrap()
	{
		require __DIR__ . DIRECTORY_SEPARATOR . 'Function' . self::EXT;
	}

	public static function load()
	{
		$commands = [
			'Database',
			'Setting',
			'App',
			'Autoload',
		];

		foreach ($commands as $index) {
			$configPath = self::PATH . $index . self::EXT;
			if(file_exists($configPath)) {
				Yii::$app->params[self::PREFIX . $index] = require $configPath;
			}
		}

		return true;
	}

	public static function bind()
	{
		$configs = Config::get('Autoload', 'models');
		foreach ($configs as $index => $class) {
			$gen = new Gen(new $class);
			$gen->bind();
		}

		return true;
	}

	public static function get($index, $key)
	{
		$result = '';
		$name   = self::PREFIX . $index;
		if(isset(Yii::$app->params[$name])) {
			if($key == '*') {
				$result = Yii::$app->params[$name];
			} else {
				$result = isset(Yii::$app->params[$name][$key]) ? Yii::$app->params[$name][$key] : '';
			}
		}

		return $result;
	}

}