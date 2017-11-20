<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\Helpers;

class SelectInput
{
	private $data;

	public function setData($data)
	{
		$this->data = Helpers::convertArrayToStr($data);
	}

	public function run($attribute)
	{
		return "\$form->field(\$model, '$attribute')->dropDownList([" . $this->data . "], ['prompt' => ''])";
	}
}