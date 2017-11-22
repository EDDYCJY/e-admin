<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;
//use Eadmin\Kernel\Support\Helpers;

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
		$this->options = VarDumper::exportSeparator($options);
	}

	public function setPluginOptions($options)
	{
		$this->pluginOptions = VarDumper::exportSeparator($options);
	}

	public function run($attribute, $multiple = false)
	{
		$params = [
			'options' => [
				'separator' => '',
				'value' => $this->options,
			],
			'pluginOptions' => [
				'separator' => '',
				'value' => $this->pluginOptions,
			],
		];
		$params = VarDumper::exportSeparator($params);

		$widget = "->widget('$this->className', $params)";
		if($multiple === true) {
			return "\$form->field(\$model, '{$attribute}[]')" . $widget;
		}

		return "\$form->field(\$model, '$attribute')" . $widget;
	}

}