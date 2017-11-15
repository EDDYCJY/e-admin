<?php

namespace Eadmin\Entity;

use backend\models\AdminMenu;

class AdminMenuEntity extends AdminMenu
{
	public static function getMenus()
	{
		$map = [
			'is_show' => 1,
			'state' => 1,
		];

		$field = 'id,parent_id,name,url';

		return self::find()->select($field)->where($map)->asArray()->all();
	}
}