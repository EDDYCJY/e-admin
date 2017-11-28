<?php

namespace Eadmin\Expand\Form;

/**
 * Class Textarea
 * @package Eadmin\Expand\Form
 */
class Textarea
{
    /**
     * @param  string $attribute field attribute
     * @return string
     */
	public function run($attribute)
	{
		return "\$form->field(\$model, '$attribute')->textarea(['rows' => 6])";
	}
}