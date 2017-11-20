<?php

namespace Eadmin\Expand\Form;

class UeditorTextarea
{
	private $className;

	public function __construct()
	{
		$this->className = \Ueditor\Widgets\Ueditor::className();
	}

	public function run($attribute)
	{
		return "\$form->field(\$model, '$attribute')->widget('$this->className');";
	}

}