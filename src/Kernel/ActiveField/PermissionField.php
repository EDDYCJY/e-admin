<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\PermissionCheckboxList;

class PermissionField extends ActiveField
{
	public function start()
	{
		$object = new PermissionCheckboxList();

        return $object->run($this->attribute);
	}
}