<?php

namespace Eadmin\Expand\View;

use yii\helpers\Html;
use Eadmin\Kernel\Support\VarDumper;
use Eadmin\Kernel\Support\Container;
use Eadmin\Config;

class StateField
{
	const SUCCESS_CODE = 1;

    /**
     * @var string
     */
	public static $tag = 'i';

    /**
     * @var string
     */
	public static $format = 'html';

    /**
     * @var array
     */
	public static $options = [
		'success' => [
			'class' => 'fa fa-check',
			'style' => 'color: green;',
		],
		'error' => [
			'class' => 'fa fa-close',
			'style' => 'color: red;',
		],
	];

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
			$flag = 'error';
			if($model->$attribute == self::SUCCESS_CODE) {
				$flag = 'success';
			}

			$result = Html::tag(self::$tag, '', [
				'class' => self::$options[$flag]['class'],
				'style' => self::$options[$flag]['style'],
			]);
		}

		return $result;
	}

    /**
     * Get GridView Filter
     *
     * @param  string $attribute field attribute
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
		$values = [
			'attribute' => $attribute,
			'format' => 'html',
			'value'  => [
				'separator' => '',
				'value' => "function (\$model) {
					return Eadmin\Expand\View\StateField::value('$attribute', \$model);
				}",
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