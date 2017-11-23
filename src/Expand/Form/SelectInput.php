<?php

namespace Eadmin\Expand\Form;

use yii\helpers\VarDumper;

class SelectInput
{
	private $data;

	public function setData($data)
	{
		$this->data = $data;
	}

	public function run($attribute)
	{
		$params = VarDumper::export($this->data);

		return "\$form->field(\$model, '$attribute')->dropDownList($params, ['prompt' => ''])";
	}
}