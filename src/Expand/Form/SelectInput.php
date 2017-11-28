<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class SelectInput
 * @package Eadmin\Expand\Form
 */
class SelectInput
{
    /**
     * @var array
     */
	private $data;

    /**
     * @param array $data
     */
	public function setData($data)
	{
		$this->data = $data;
	}

    /**
     * @param  string $attribute field attribute
     * @return string
     */
	public function run($attribute)
	{
		$params = VarDumper::exportSeparator($this->data);

		return "\$form->field(\$model, '$attribute')->dropDownList($params, ['prompt' => ''])";
	}
}