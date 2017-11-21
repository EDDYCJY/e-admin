<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\Helpers;

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
		$this->options = Helpers::convertArrayToStr($options);
	}

	public function setClientOptions($clientOptions)
	{
		$this->clientOptions = Helpers::convertArrayToStr($clientOptions);
	}

	public function run($attribute)
	{
        $widget = "->widget('$this->className',['items' => $this->items, 'options' => [$this->options], 'clientOptions' => [$this->clientOptions]])";

		return "\$form->field(\$model, '$attribute')"  . $widget;
	}	
}