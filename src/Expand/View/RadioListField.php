<?php

namespace Eadmin\Expand\View;

use Eadmin\Kernel\Support\Helpers;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\VarDumper;
use Eadmin\Config;

/**
 * Class RadioListField
 * @package Eadmin\Expand\View
 */
class RadioListField
{
    /**
     * Get GridView Value
     *
     * @param  string $attribute field attribute
     * @param  object $model     model object
     * @return string
     */
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

    /**
     * Get GridView Filter
     *
     * @param  string $attribute field attribute
     * @param  array  $container model container
     * @return array
     */
	public static function filter($attribute, $container)
	{
		$modelParams = $container['modelParams'][$attribute];

		$result = [];
		if(isset($modelParams['options']['choices'])) {
			$result = $modelParams['options']['choices'];
		}

		return $result;
	}

    /**
     * Get GridView Column
     *
     * @param  string $attribute field attribute
     * @param  array  $container model container
     * @return string
     */
	public static function column($attribute, $container)
	{
		$headClosure = "function (\$model) {" . "\n";
		$textClosure = str_repeat(' ', 20) . "return Eadmin\Expand\View\RadioListField::value('$attribute', \$model);";
		$footClosure = "\n" . str_repeat(' ', 16) . "}";

		$values = [
			'attribute' => $attribute,
			'value'  => [
				'separator' => '',
				'value' => $headClosure . $textClosure . $footClosure,
			],
			'filter' => [
				'separator' => '',
				'value' => VarDumper::exportSeparator(self::filter($attribute, $container), [
					'headSpace' => 20, 
					'footSpace' => 16
				]),
			],
		];


		return VarDumper::exportSeparator($values, ['headSpace' => 16, 'footSpace' => 12]);
	}
}