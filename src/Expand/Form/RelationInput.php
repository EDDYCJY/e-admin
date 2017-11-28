<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class RelationInput
 * @package Eadmin\Expand\Form
 */
class RelationInput
{
    /**
     * @var string
     */
	private $className;

    /**
     * @var array
     */
	private $data;

    /**
     * @var array
     */
	private $options;

    /**
     * @var array
     */
	private $pluginOptions;

    /**
     * RelationInput constructor.
     */
	public function __construct()
	{
		$this->className = \kartik\select2\Select2::className();
	}

    /**
     * @param array $data
     */
	public function setData($data)
	{
		$this->data = $data;
	}

    /**
     * @param array $options
     */
	public function setOptions($options)
	{
		$this->options = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

    /**
     * @param array $options
     */
	public function setPluginOptions($options)
	{
		$this->pluginOptions = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

    /**
     * @param  string $attribute field attribute
     * @return string
     */
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