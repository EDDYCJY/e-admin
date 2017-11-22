<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

class DateInput
{
	private $className;

	private $options;

	private $pluginOptions;

	public function __construct()
	{
		$this->className = \kartik\date\DatePicker::className();
	}

	public function setOptions($options)
	{
		$this->options = $options;
	}

	public function setPluginOptions($options)
	{
		$this->pluginOptions = $options;
	}

	public function run($attribute)
	{
		$params = [
			'options' => $this->options,
			'pluginOptions' => $this->pluginOptions,
		];
		$params = VarDumper::export($params);

		return "\$form->field(\$model, '$attribute')->widget('$this->className', $params)";
	}

}