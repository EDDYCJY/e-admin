<?php

namespace Eadmin\Expand\Form;

/**
 * Class UeditorTextarea
 * @package Eadmin\Expand\Form
 */
class UeditorTextarea
{
    /**
     * @var string
     */
	private $className;

    /**
     * UeditorTextarea constructor.
     */
	public function __construct()
	{
		$this->className = \Ueditor\Widgets\Ueditor::className();
	}

    /**
     * @param  string $attribute field attribute
     * @return string
     */
	public function run($attribute)
	{
		return "\$form->field(\$model, '$attribute')->widget('$this->className');";
	}

}