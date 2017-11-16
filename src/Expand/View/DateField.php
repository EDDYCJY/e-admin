<?php

namespace Eadmin\Expand\View;

use yii\helpers\Html;
use kartik\date\DatePicker;
use Eadmin\Kernel\Support\Helpers;

class DateField
{
	public static $format = [
		'date', 
		'php:Y-m-d H:i:s',
	];

	public static function filter($attribute)
	{
		$startField = $attribute . '_start';
		$endField   = $attribute . '_end';

		$startValue = (! empty($_GET[$startField])) ? date('Y-m-d', strtotime($_GET[$startField])) : '';
		$endValue   = (! empty($_GET[$endField]))   ? date('Y-m-d', strtotime($_GET[$endField])) : '';

		return DatePicker::widget([
            'name'   => $startField,
            'value'  => $startValue,
            'type'   => DatePicker::TYPE_RANGE,
            'name2'  => $endField,
            'value2' => $endValue,
            'pluginOptions' => [
                'autoclose'=> true,
                'format'   => 'yyyy-m-dd',
            ]
        ]);
	}

	public static function column($attribute, $container)
	{
		$values = [
			'attribute' => $attribute,
			'format' => [
				'separator' => '',
				'value'  => '[' . Helpers::convertArrayToStr(self::$format) . ']',
			],
			'filter' => [
				'separator' => '',
				'value' => 'Eadmin\Expand\View\DateField::filter(' . "'" . $attribute . "'" . ')',
			],
		];

		return Helpers::convertArrayToStr($values);
	}
}