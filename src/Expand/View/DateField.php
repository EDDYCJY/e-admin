<?php

namespace Eadmin\Expand\View;

use yii\helpers\Html;
use Eadmin\Kernel\Support\Helpers;

class DateField
{
	public static $format = [
		'date', 
		'php:Y-m-d H:i:s',
	];


	public static function column($attribute, $container)
	{
		$values = [
			'attribute' => $attribute,
			'format' => [
				'separator' => '',
				'value' => '[' . Helpers::convertArrayToStr(self::$format) . ']'
			],
		];

		return Helpers::convertArrayToStr($values);
	}
}