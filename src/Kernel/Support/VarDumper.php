<?php

namespace Eadmin\Kernel\Support;

use yii\helpers\BaseVarDumper;

class VarDumper extends BaseVarDumper
{
	public static function exportSeparator($array, $options = [])
	{
		$headSpace = (! empty($options['headSpace'])) ? $options['headSpace'] : ((! empty($options['isChidren']) && $options['isChidren']) ? 16 : 12);
		$footSpace = (! empty($options['footSpace'])) ? $options['footSpace'] : ((! empty($options['isChidren']) && $options['isChidren']) ? 12 : 8);

	    $_output = '[' . "\n";
	    foreach ($array as $key => $params) {
	    	$prefix = str_repeat(' ', $headSpace) . "'" . $key;
	        if(isset($params['separator']) && isset($params['value'])) {
	        	$separator = $params['separator'];
	        	$value = $params['value'];
	        } else {
	        	$separator = "'";
	        	$value = $params;
	        }

	        $suffix = $separator . ',' . "\n";
	        $arrow  = "'" . ' => ' . $separator;

	        $_output .= $prefix . $arrow . $value . $suffix;
	    }
		
		$_output .= str_repeat(' ', $footSpace) . ']';
		
	    return trim($_output, ',');
	}

}
