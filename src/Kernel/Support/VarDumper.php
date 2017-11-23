<?php

namespace Eadmin\Kernel\Support;

use yii\helpers\BaseVarDumper;

class VarDumper extends BaseVarDumper
{
	public static function exportSeparator($array)
	{
	    $_output = '[';
	    foreach ($array as $key => $params) {
	        if(isset($params['separator']) && isset($params['value'])) {
	            $_output .= "'" . $key . "'" . ' => ' . $params['separator'] . $params['value'] . $params['separator'] . ',';
	        } else {
	            $prefix = "'" . $key ;
	            $arrow  = "'" . ' => ' . "'";
	            $suffix = "'" . ',';

	            $_output .= $prefix . $arrow .$params . $suffix;
	        }
	    }
		
		$_output .= ']';
		
	    return trim($_output, ',');
	}
}
