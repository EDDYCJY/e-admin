<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class PermissionListbox
 * @package Eadmin\Expand\Form
 */
class PermissionListbox
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
	private $clientOptions;

    /**
     * @var string
     */
	private $items;

    /**
     * PermissionListbox constructor.
     */
	public function __construct()
	{
		$this->className = \softark\duallistbox\DualListbox::className();
	}

    /**
     * @param array $items
     */
	public function setItems($items)
	{
		$this->items = $items;
	}

    /**
     * @param array $options
     */
	public function setOptions($options)
	{
		$this->options = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

    /**
     * @param array $clientOptions
     */
	public function setClientOptions($clientOptions)
	{
		$this->clientOptions = VarDumper::exportSeparator($clientOptions, ['isChidren' => true]);
	}

    /**
     * @param  string $attribute field attribute
     * @return string
     */
	public function run($attribute)
	{
		$params = [
			'items' => [
				'separator' => '',
				'value' => $this->items
			],
			'options' => [
				'separator' => '',
				'value' => $this->options,
			],
			'clientOptions' => [
				'separator' => '',
				'value' => $this->clientOptions,
			],
		];
		$params = VarDumper::exportSeparator($params);

		return "\$form->field(\$model, '$attribute')->widget('$this->className',$params)";
	}	
}