<?php

namespace Eadmin\Entity;

use backend\models\AdminRole;

class AdminRoleEntity extends AdminRole
{
	public static function getRoleInfo($id)
	{
		$map = [
			'id'    => $id,
			'state' => 1,
		];

		$field = 'id,role_name,description,permissions';

		return self::find()->where($map)->select($field)->asArray()->one();
	}

	public static function addRole($params)
	{
		$model = new AdminRole();
		$model->role_name = $params['role_name'];
		$model->description = $params['description'];
		$model->permissions = $params['permissions'];
		$model->is_show = $params['is_show'];
		$model->state = $params['state'];

		return $model->save();
	}

}