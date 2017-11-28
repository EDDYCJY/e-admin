<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class Select2Input
 * @package Eadmin\Expand\Form
 */
class Select2Input
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
     * Select2Input constructor.
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
		$this->options = $options;
	}

    /**
     * @param array $options
     */
	public function setPluginOptions($options)
	{
		$this->pluginOptions = $options;
	}

    /**
     * @param  string $attribute field attribute
     * @return string
     */
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