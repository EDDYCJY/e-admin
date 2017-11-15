<?php

namespace Eadmin\Expand\Form;

use yii\helpers\ArrayHelper;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Entity\AdminMenuEntity;
use backend\models\AdminRole;
use yii\helpers\VarDumper;

class PermissionCheckboxList
{
	public function run($attribute)
	{
		$permissions = AdminMenuEntity::getMenus();
		$permissions = ArrayHelper::index($permissions, 'id');
		$permissions = ArrayHelper::getColumn($permissions, 'name');
		$permissions = Helpers::convertArrayToStr($permissions);

		$classOptions = preg_replace("/\n\s*/", ' ', VarDumper::export([
            'class' => 'checkbox',
        ]));

		return "\$form->field(\$model, '$attribute')->checkboxList([$permissions], $classOptions)";
	}	
}