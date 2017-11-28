<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class FileInput
 * @package Eadmin\Expand\Form
 */
class FileInput
{
    /**
     * @var string
     */
	private $className;

    /**
     * @var array
     */
	private $options;

    /**
     * @var array
     */
	private $pluginOptions;

    /**
     * FileInput constructor.
     */
	public function __construct()
	{
		$this->className = \kartik\file\FileInput::className();
	}

    /**
     * @param array $options
     */
	public function setOptions($options)
	{
		$this->options = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

    /**
     * @param array $pluginOptions
     */
	public function setPluginOptions($pluginOptions)
	{
		$this->pluginOptions = VarDumper::exportSeparator($pluginOptions, ['isChidren' => true]);
	}

    /**
     * @param string $attribute field attribute
     * @param bool   $multiple  multiple upload
     * @return string
     */
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