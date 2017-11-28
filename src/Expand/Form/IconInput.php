<?php

namespace Eadmin\Expand\Form;

use Eadmin\Kernel\Support\VarDumper;

/**
 * Class IconInput
 * @package Eadmin\Expand\Form
 */
class IconInput
{
    /**
     * @var string
     */
	private $className;

    /**
     * @var array
     */
	private $options;

    /**
     * IconInput constructor.
     */
	public function __construct()
	{
		$this->className = \Iconpicker\Widgets\Iconpicker::className();
	}

    /**
     * @param array $options
     */
	public function setOptions($options)
	{
		$this->options = VarDumper::exportSeparator($options, ['isChidren' => true]);
	}

    /**
     * @param  string $attribute field attribute
     * @return string
     */
	public function run($attribute)
	{
		$params = [
			'options' => [
				'separator' => '',
				'value' => $this->options
			],
		];
		$params = VarDumper::exportSeparator($params);

		return "\$form->field(\$model, '$attribute')->widget('$this->className', $params)";
	}
}