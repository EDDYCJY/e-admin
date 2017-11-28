<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class DateInput
 * @package Eadmin\Expand\Form
 */
class DateInput
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
     * DateInput constructor.
     */
	public function __construct()
	{
		$this->className = \kartik\date\DatePicker::className();
	}

    /**
     * @param array $options
     */
	public function setOptions($options)
	{
		$this->options = $options;
	}

    /**
     * @param array $pluginOptions
     */
	public function setPluginOptions($pluginOptions)
	{
		$this->pluginOptions = $pluginOptions;
	}

    /**
     * @param  string $attribute model attribute
     * @return string
     */
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