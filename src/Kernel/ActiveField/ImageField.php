<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\FileInput;

class ImageField extends ActiveField
{
	private $options;

	private $pluginOptions;

	public function setOptions()
	{
		$this->options = [
			'accept' => 'image/*',
		];

		return true;
	}

	public function setPluginOptions()
	{
		$this->pluginOptions = [
            'previewFileType' => 'image',
            'initialPreview'  => [
                'separator' => '',
                'value'     => "! empty(\$model->{$this->attribute}) ? Helpers::getFullImagePaths(\$model->{$this->attribute}) : ''", 
            ],
            'showUpload' => [
                'separator' => '',
                'value' => "false"
            ],
            'showRemove' => [
                'separator' => '',
                'value' => "false"
            ],
            'initialPreviewAsData' => [
                'separator' => '',
                'value' => "true"
            ],
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
		$this->setOptions();
		$this->setPluginOptions();

        $object = new FileInput();
        $object->setOptions($this->getOptions());
        $object->setPluginOptions($this->getPluginOptions());

        return $object->run($this->attribute);
	}	
}