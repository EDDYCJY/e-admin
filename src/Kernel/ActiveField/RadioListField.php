<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Kernel\Support\VarDumper;
use Eadmin\Basic\ActiveField;

/**
 * Class RadioListField
 * @package Eadmin\Kernel\ActiveField
 */
class RadioListField extends ActiveField
{
	private $choices;

	private $htmlOptions;

	public function init()
	{
		$this->setChoices();
		$this->setHtmlOptions();
	}

	public function setChoices()
	{
		$this->choices = $this->container['modelParams'][$this->attribute]['options']['choices'];

		return true;
	}

	public function setHtmlOptions()
	{
		$this->htmlOptions = [
			 'class' => 'radio',
		];

		return true;
	}

	public function getChoices()
	{
		return VarDumper::exportSeparator($this->choices);
	}

	public function getHtmlOptions()
	{
		return VarDumper::exportSeparator($this->htmlOptions);
	}

	public function start()
	{
        return "\$form->field(\$model, '{$this->attribute}')->radioList({$this->getChoices()}, {$this->getHtmlOptions()})";
	}
}