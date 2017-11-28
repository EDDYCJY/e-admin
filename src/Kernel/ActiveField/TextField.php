<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\Textarea;

/**
 * Class TextField
 * @package Eadmin\Kernel\ActiveField
 */
class TextField extends ActiveField
{
	public function start()
	{
        $object = new Textarea();

        return $object->run($this->attribute);
	}
}