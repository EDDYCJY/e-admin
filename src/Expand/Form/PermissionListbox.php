<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

class PermissionListbox
{
	private $className;

	private $options;

	private $clientOptions;

	private $items;

	public function __construct()
	{
		$this->className = \softark\duallistbox\DualListbox::className();
	}

	public function setItems($items)
	{
		$this->items = $items;
	}

	public function setOptions($options)
	{
		$this->options = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

	public function setClientOptions($clientOptions)
	{
		$this->clientOptions = VarDumper::exportSeparator($clientOptions, ['isChidren' => true]);
	}

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