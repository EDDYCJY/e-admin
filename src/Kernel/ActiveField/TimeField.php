<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\DateInput;

/**
 * Class TimeField
 * @package Eadmin\Kernel\ActiveField
 */
class TimeField extends ActiveField
{
	public $pluginOptions;

	public function setPluginOptions()
	{
		$this->pluginOptions = [
            'autoclose'=> true,
            'format' => 'yyyy-m-dd',
            'todayHighlight' => true
        ];

        return true;
	}

	public function getPluginOptions()
	{
		return $this->pluginOptions;
	}

	public function start()
	{	
		$this->setPluginOptions();

        $object = new DateInput();
        $object->setPluginOptions($this->getPluginOptions());

        return $object->run($this->attribute);
	}
}