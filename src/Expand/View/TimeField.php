<?php

namespace Eadmin\Expand\View;

use kartik\date\DatePicker;
use Eadmin\Kernel\Support\VarDumper;

/**
 * Class TimeField
 * @package Eadmin\Expand\View
 */
class TimeField
{
    /**
     * @var array
     */
	public static $format = [
		'date', 
		'php:Y-m-d H:i:s',
	];

    /**
     * Get GridView Filter
     *
     * @param  string $attribute field attribute
     * @return string
     */
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
			'format' => [
                'separator' => '',
                'value' => VarDumper::exportSeparator(self::$format, [
                    'headSpace' => 20, 
                    'footSpace' => 16
                ]),
            ],
			'filter' => [
                'separator' => '',
                'value' => 'Eadmin\Expand\View\TimeField::filter(' . "'" . $attribute . "'" . ')',
            ],
		];

		return VarDumper::exportSeparator($values, ['headSpace' => 16, 'footSpace' => 12]);
	}
}