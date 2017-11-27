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
		$this->options = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

	public function run($attribute)
	{
		$params = [
			'options' => [
				'separator' => '',
				'value' => $this->options
			],
		];
		$params = VarDumper::exportSeparator($params);

		return "\$form->field(\$model, '$attribute')->widget('$this->className', $params)";
	}
}