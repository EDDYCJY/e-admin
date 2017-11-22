<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

class Select2Input
{
	private $className;

	private $data;

	private $options;

	private $pluginOptions;

	public function __construct()
	{
		$this->className = \kartik\select2\Select2::className();
	}

	public function setData($data)
	{
		$this->data = $data;
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
			'data' => $this->data,
			'options' => $this->options,
			'pluginOptions' => $this->pluginOptions,
		];
		$params = VarDumper::export($params);

		return "\$form->field(\$model, '$attribute')->widget('$this->className', $params)";
	}
}