<?php

namespace Eadmin\Expand\View;

use Eadmin\Kernel\Support\Helpers;
use Eadmin\Kernel\Support\Container;
use Eadmin\Config;

class RadioListField
{
	public static function value($attribute, $model)
	{
		$result = '';
		if(isset($model->$attribute)) {
			$className = Helpers::getLastIndex(get_class($model));
			$tableName = Helpers::getUnderscore($className);
			$tablePrefix = Config::get('Database', 'table_prefix');
			$container = Container::make($tablePrefix . $tableName);

			$filter = self::filter($attribute, $container);
			foreach ($filter as $key => $value) {
				if($key == $model->$attribute) {
					$result = $value;
					break;
				}
			}
		}

		return $result;
	}

	public static function filter($attribute, $container)
	{
		$modelParams = $container['modelParams'][$attribute];

		$result = [];
		if(isset($modelParams['options']['choices'])) {
			$result = $modelParams['options']['choices'];
		}

		return $result;
	}

	public static function column($attribute, $container)
	{
		$values = [
			'attribute' => $attribute,
			'value'  => [
				'separator' => '',
				'value' => "function (\$model) {
					return Eadmin\Expand\View\RadioListField::value('$attribute', \$model);
				}",
			],
			'filter' => [
				'separator' => '',
				'value' => '[' . Helpers::convertArrayToStr(self::filter($attribute, $container)) . ']',
			],
		];

		return Helpers::convertArrayToStr($values);
	}
}