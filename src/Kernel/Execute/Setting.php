<?php

namespace Eadmin\Kernel\Execute;

use Yii;
use Eadmin\Basic\ExecuteLock;

class Setting extends ExecuteLock
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