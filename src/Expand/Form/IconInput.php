<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\Helpers;

class IconInput
{
	private $className;

	private $options;

	public function __construct()
	{
		$this->className = \Iconpicker\Widgets\Iconpicker::className();
	}

	public function setOptions($options)
	{
		$this->options = Helpers::convertArrayToStr($options);
	}

	public function run($attribute)
	{
		$widget = "->widget('$this->className', ['options' => [$this->options]])";

		return "\$form->field(\$model, '$attribute')" . $widget;
	}
}