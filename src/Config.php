<?php
namespace Eadmin;

use Yii;
use Eadmin\Kernel\Gen\Setting;

class Config
{
	const PATH = __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR;

	const EXT = '.php';

	const PREFIX = 'eadmin';

	public static function init()
	{
		$commands = [
			'Database',
			'Setting',
			'App',
		];

		foreach ($commands as $index) {
			$configPath = self::PATH . $index . self::EXT;
			if(file_exists($configPath)) {
				Yii::$app->params[self::PREFIX . $index] = require $configPath;
			}
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