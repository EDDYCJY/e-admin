<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\Helpers;

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
		$this->options = Helpers::convertArrayToStr($options);
	}

	public function setPluginOptions($options)
	{
		$this->pluginOptions = Helpers::convertArrayToStr($options);
	}

	public function run($attribute)
	{
		$widget = "->widget('$this->className', ['options' => [$this->options], 'pluginOptions' => [$this->pluginOptions]])";

		return "\$form->field(\$model, '$attribute')" . $widget;
	}

}