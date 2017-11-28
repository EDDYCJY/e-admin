<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\Select2Input;

/**
 * Class Select2Field
 * @package Eadmin\Kernel\ActiveField
 */
class Select2Field extends ActiveField
{
	private $data;

	private $options;

	private $pluginOptions;

	public function init()
	{
		$this->setData();
		$this->setOptions();
		$this->setPluginOptions();
	}

	public function setData()
	{
		$data = [];
		$fieldValue = $this->container['modelParams'][$this->attribute];
		if(isset($fieldValue['options']['choices'])) {
			$data = $fieldValue['options']['choices'];
		}

		$this->data = $data;
	}

	public function setOptions()
	{
		$this->options = [
			'placeholder' => 'Select a state ...',
		];
	}

	public function setPluginOptions()
	{
		$this->pluginOptions = [
			'allowClear' => true,
		];
	}

	public function getData()
	{
		return $this->data;
	}

	public function getOptions()
	{
		return $this->options;
	}

	public function getPluginOptions()
	{
		return $this->pluginOptions;
	}

	public function start()
	{
		$object = new Select2Input();
		$object->setData($this->getData());
        $object->setOptions($this->getOptions());
        $object->setPluginOptions($this->getPluginOptions());

        return $object->run($this->attribute);
	}
}