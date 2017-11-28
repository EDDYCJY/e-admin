<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\FileInput;

/**
 * Class ImagesField
 * @package Eadmin\Kernel\ActiveField
 */
class ImagesField extends ActiveField
{
	private $options;

	private $pluginOptions;

	public function init()
	{
		$this->setOptions();
		$this->setPluginOptions();
	}

	public function setOptions()
	{
		$this->options = [
		  	'accept'   => 'image/*',
            'multiple' => true,
		];

		return true;
	}

	public function setPluginOptions()
	{
		$this->pluginOptions = [
            'previewFileType' => 'image',
            'initialPreview' => [
            	'separator' => '',
            	'value' => "! empty(\$model->{$this->attribute}) ? Helpers::getFullImagePaths(explode(',', \$model->{$this->attribute})) : ''",
            ], 
            'showUpload' => false,
            'showRemove' => false,
            'initialPreviewAsData' => true,
        ];

        return true;
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
        $object = new FileInput();
        $object->setOptions($this->getOptions());
        $object->setPluginOptions($this->getPluginOptions());

        return $object->run($this->attribute, true);
	}
}