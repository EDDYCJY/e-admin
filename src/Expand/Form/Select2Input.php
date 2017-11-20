<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\Helpers;

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
		$this->data = Helpers::convertArrayToStr($data);
	}

	public function setOptions($options)
	{
		$this->options = Helpers::convertArrayToStr($options);
	}

	public function setPluginOptions($options)
	{
		$this->pluginOptions = Helpers::convertArrayToStr($options);
	}

	public function run($attribute)
	{
		$widget = "->widget('$this->className', ['data' => [$this->data], 'options' => [$this->options], 'pluginOptions' => [$this->pluginOptions]])";

		return "\$form->field(\$model, '$attribute')" . $widget;
	}
}