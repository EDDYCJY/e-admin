<?php

namespace Eadmin\Entity;

use yii\helpers\ArrayHelper;
use backend\models\AdminMenu;

class AdminMenuEntity extends AdminMenu
{
	public static function getMenus($id)
	{
		$map = [
			'id' => explode(',', $id),
			'is_show' => 1,
			'state' => 1,
		];

		$field = 'id,parent_id,icon,name,url';

		return self::find()->select($field)->where($map)->asArray()->all();
	}

	public static function getAllMenu()
	{
		$map = [
			'is_show' => 1,
			'state' => 1,
		];

		$field = 'id,parent_id,icon,name,url';

		return self::find()->select($field)->where($map)->asArray()->all();
	}

	public static function getAllPermission()
	{
		$permissions = self::getAllMenu();
		$permissions = ArrayHelper::index($permissions, 'id');
		
		return ArrayHelper::getColumn($permissions, 'name');
	}

}