<?php

namespace Eadmin\Kernel\Execute;

use Yii;

class Setting
{	
	public $objecter;

	public function __construct($object)
	{
		$this->objecter = $object;
	}

	public function start($vars)
	{
		Yii::$app->params['global_settings'] = $vars;
	}
}