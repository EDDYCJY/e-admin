<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\FileInput;

class ImagesField extends ActiveField
{
	private $options;

	private $pluginOptions;

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
                'value'     => "! empty(\$model->{$this->attribute}) ? Helpers::getFullImagePaths(explode(',', \$model->{$this->attribute})) : ''",  
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

        return $object->run($this->attribute, true);
	}
}