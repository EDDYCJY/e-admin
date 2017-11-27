<?php

namespace Eadmin\Kernel\Support;

use yii\helpers\BaseVarDumper;

class VarDumper extends BaseVarDumper
{
	public static $headSpace = [
		'normal'  => 12,
		'chidren' => 16,
	];

	public static $footSpace = [
		'normal'  => 8,
		'chidren' => 12,
	];

	public static function exportSeparator($array, $options = [])
	{
		if(! empty($options['headSpace'])) {
			$headSpace = $options['headSpace'];
		} else {
			$headSpace = (! empty($options['isChidren']) && $options['isChidren']) ? self::$headSpace['chidren'] : self::$headSpace['normal'];
		}

		if(! empty($options['footSpace'])) {
			$footSpace = $options['footSpace'];
		} else {
			$footSpace = (! empty($options['isChidren']) && $options['isChidren']) ? self::$footSpace['chidren'] : self::$footSpace['normal'];
		}

	    $_output = '[' . "\n";
	    foreach ($array as $key => $params) {
	        if(isset($params['separator']) && isset($params['value'])) {
	            $_output .= str_repeat(' ', $headSpace) . "'" . $key . "'" . ' => ' . $params['separator'] . $params['value'] . $params['separator'] . ',' . "\n";
	        } else {
	            $prefix = str_repeat(' ', $headSpace) ."'" . $key ;
	            $arrow  = "'" . ' => ' . "'";
	            $suffix = "'" . ',' . "\n";

	            $_output .= $prefix . $arrow .$params . $suffix;
	        }
	    }
		
		$_output .= str_repeat(' ', $footSpace) . ']';
		
	    return trim($_output, ',');
	}
}
