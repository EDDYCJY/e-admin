<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\UeditorTextarea;

class UeditorField extends ActiveField
{
	public function start()
	{	
        $object = new UeditorTextarea();

        return $object->run($this->attribute);
	}
}