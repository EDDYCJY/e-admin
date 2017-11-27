<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

class SelectInput
{
	private $data;

	public function setData($data)
	{
		$this->data = $data;
	}

	public function run($attribute)
	{
		$params = VarDumper::exportSeparator($this->data);

		return "\$form->field(\$model, '$attribute')->dropDownList($params, ['prompt' => ''])";
	}
}