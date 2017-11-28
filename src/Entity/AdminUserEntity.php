<?php

namespace Eadmin\Entity;

use Yii;
use backend\models\AdminUser;

/**
 * Class AdminUserEntity
 * @package Eadmin\Entity
 */
class AdminUserEntity extends AdminUser
{
    /**
     * Get User Info
     *
     * @param  int    $id        user_id
     * @param  string $userName  user_name
     * @return static
     */
	public static function getUserInfo($id, $userName)
	{
        $map = [
            'id' => $id,
            'user_name' => $userName,
            'state' => 1,
        ];

        return self::findOne($map);
	}

    /**
     * Add User
     *
     * @param  array $params user_info
     * @return bool
     */
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