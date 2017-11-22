<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

class IconInput
{
	private $className;

	private $options;

	public function __construct()
	{
		$this->className = \Iconpicker\Widgets\Iconpicker::className();
	}

	public function setOptions($options)
	{
		$this->options = $options;
	}

	public function run($attribute)
	{
		$params = [
			'options' => $this->options
		];
		$params = VarDumper::export($params);

		return "\$form->field(\$model, '$attribute')->widget('$this->className', $params)";
	}
}