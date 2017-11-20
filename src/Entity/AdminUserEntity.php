<?php

namespace Eadmin\Entity;

use Yii;
use backend\models\AdminUser;

class AdminUserEntity extends AdminUser
{
	public static function getUserInfo($id, $userName)
	{
        $map = [
            'id' => $id,
            'user_name' => $userName,
            'state' => 1,
        ];

        return self::findOne($map);
	}

	public static function addUser($params)
	{
		$model = new AdminUser();
		$model->role_id    = $params['role_id'];
		$model->user_name  = $params['user_name'];
		$model->password   = $params['password'];
		$model->created_on = time();
		$model->created_by = $params['created_by'];
		$model->modify_on  = time();
		$model->modify_by  = $params['modify_by'];

		return $model->save();
	}

}