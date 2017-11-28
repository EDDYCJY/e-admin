<?php

namespace Eadmin\Entity;

use backend\models\AdminMenu;
use Eadmin\Kernel\Support\Helpers;

/**
 * Class AdminMenuEntity
 * @package Eadmin\Entity
 */
class AdminMenuEntity extends AdminMenu
{
    /**
     * Add Menu
     *
     * @param  array $params menu data
     * @return bool
     */
	public static function addMenu($params)
	{
		$model = new AdminMenu();
		$model->menu_name = $params['menu_name'];
		$model->url = $params['url'];
		$model->parent_id = $params['parent_id'];
		$model->is_show = $params['is_show'];

		return $model->save();
	}

    /**
     * Get Menus
     *
     * @param  int $id menu ids
     * @return array|\yii\db\ActiveRecord[]
     */
	public static function getMenus($id)
	{
		$map = [
			'id' => explode(',', $id),
			'is_show' => 1,
			'state' => 1,
		];

		$field = 'id,parent_id,icon,menu_name,url';

		return self::find()->select($field)->where($map)->asArray()->all();
	}

    /**
     * Get All Menu
     *
     * @return array|\yii\db\ActiveRecord[]
     */
	public static function getAllMenu()
	{
		$map = [
			'is_show' => 1,
			'state' => 1,
		];

		$field = 'id,parent_id,icon,menu_name,url';

		return self::find()->select($field)->where($map)->asArray()->all();
	}

    /**
     * Get All Permission
     *
     * @return array
     */
	public static function getAllPermission()
	{
		return Helpers::getSelectMap(self::getAllMenu(), 'id', 'menu_name');
	}

}