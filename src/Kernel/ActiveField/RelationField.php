<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Config;
use Eadmin\Expand\Form\RelationInput;

/**
 * Class RelationField
 * @package Eadmin\Kernel\ActiveField
 */
class RelationField extends ActiveField
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
		$relations = $this->container['modelParams'][$this->attribute]['relations'];

		$data = null;
		if(! empty($relations)) {
			$modelClass = Config::get('App', 'eadmin_generator_configs')['model']['namespace'];
			$modelData = '\\' . $modelClass . '\\' . ucfirst($relations['class']) . '::find()->asArray()->all()';
			$index = $relations['link'];
			$attribute = $relations['attribute'];

			$data = 'Helpers::getSelectMap(' . $modelData . ', ' . "'" . $index . "'" . ', ' . "'" . $attribute . "'" . ')'; 
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
		$object = new RelationInput();
		$object->setData($this->getData());
        $object->setOptions($this->getOptions());
        $object->setPluginOptions($this->getPluginOptions());

        return $object->run($this->attribute);
	}
}