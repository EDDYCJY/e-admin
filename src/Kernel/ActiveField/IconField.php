<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\IconInput;

/**
 * Class IconField
 * @package Eadmin\Kernel\ActiveField
 */
class IconField extends ActiveField
{
	public function start()
	{
		$object = new IconInput();
        $object->setOptions([]);

        return $object->run($this->attribute);
	}
}