<?php

namespace Eadmin\Expand\Form;

class Textarea
{
	public function run($attribute)
	{
		return "\$form->field(\$model, '$attribute')->textarea(['rows' => 6])";
	}
}