<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\SelectInput;

/**
 * Class SelectField
 * @package Eadmin\Kernel\ActiveField
 */
class SelectField extends ActiveField
{
    private $data;

	public function init()
	{
		$this->setData();
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

	public function getData()
	{
		return $this->data;
	}

	public function start()
	{
		$object = new SelectInput();
		$object->setData($this->getData());

        return $object->run($this->attribute);
	}
}