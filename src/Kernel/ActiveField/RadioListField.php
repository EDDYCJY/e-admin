<?php

namespace Eadmin\Kernel\ActiveField;

use yii\helpers\VarDumper;
use Eadmin\Basic\ActiveField;

class RadioListField extends ActiveField
{
	private $choices;

	private $htmlOptions;

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
		return preg_replace("/\n\s*/", ' ', VarDumper::export($this->choices));
	}

	public function getHtmlOptions()
	{
		return preg_replace("/\n\s*/", ' ', VarDumper::export($this->htmlOptions));
	}

	public function start()
	{
		$this->setChoices();
		$this->setHtmlOptions();

        return "\$form->field(\$model, '{$this->attribute}')->radioList({$this->getChoices()}, {$this->getHtmlOptions()})";
	}
}