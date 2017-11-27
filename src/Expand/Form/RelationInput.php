<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

class RelationInput
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
		$this->options = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

	public function setPluginOptions($options)
	{
		$this->pluginOptions = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

	public function run($attribute)
	{
		$params = [
			'data' => [
				'separator' => '',
				'value' => $this->data,
			],
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

		return "\$form->field(\$model, '$attribute')->widget('$this->className', $params)";
	}
}