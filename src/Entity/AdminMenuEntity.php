<?php

namespace Eadmin\Entity;

use yii\helpers\ArrayHelper;
use backend\models\AdminMenu;
use Eadmin\Kernel\Support\Helpers;

class AdminMenuEntity extends AdminMenu
{
	public static function addMenu($params)
	{
		$model = new AdminMenu();
		$model->name = $params['name'];
		$model->url = $params['url'];
		$model->parent_id = $params['parent_id'];
		$model->is_show = $params['is_show'];

		return $model->save();
	}

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
		return Helpers::getSelectMap(self::getAllMenu(), 'id', 'name');
	}

}