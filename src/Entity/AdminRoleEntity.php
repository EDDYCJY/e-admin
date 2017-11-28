<?php

namespace Eadmin\Entity;

use backend\models\AdminRole;

/**
 * Class AdminRoleEntity
 * @package Eadmin\Entity
 */
class AdminRoleEntity extends AdminRole
{
    /**
     * Get Role Info
     *
     * @param  int $id role_id
     * @return array|null|\yii\db\ActiveRecord
     */
	public static function getRoleInfo($id)
	{
		$map = [
			'id'    => $id,
			'state' => 1,
		];

		$field = 'id,role_name,description,permissions';

		return self::find()->where($map)->select($field)->asArray()->one();
	}

    /**
     * Add Role
     *
     * @param  array $params role info
     * @return bool
     */
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