<?php

namespace Eadmin\Expand\Form;

use yii\helpers\VarDumper;
use Eadmin\Kernel\Support\Helpers;

class FileInput
{
	private $className;

	private $options;

	private $pluginOptions;

	public function __construct()
	{
		$this->className = \kartik\file\FileInput::className();
	}

	public function setOptions($options)
	{
		$this->options = Helpers::convertArrayToStr($options);
	}

	public function setPluginOptions($options)
	{
		$this->pluginOptions = Helpers::convertArrayToStr($options);
	}

	public function run($attribute, $multiple = false)
	{
		$widget = "->widget('$this->className', ['options' => [$this->options], 'pluginOptions' => [$this->pluginOptions]])";
		if($multiple === true) {
			return "\$form->field(\$model, '{$attribute}[]')" . $widget;
		}

		return "\$form->field(\$model, '$attribute')" . $widget;
	}

}