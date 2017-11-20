<?php

namespace Eadmin\Kernel\Extra;

use yii\helpers\ArrayHelper;
use Eadmin\Basic\Extra;
use Eadmin\Entity\AdminUserEntity;
use Eadmin\Entity\AdminMenuEntity;
use Eadmin\Entity\AdminRoleEntity;

class Admin extends Extra
{
	public function start()
	{
		$this->initAdminRole();
		$this->initAdminUser();
	}

	private function initAdminRole()
	{
		$name = 'admin_role';
		if(! $this->locker->existsLock($name)) {
			$permissions = ArrayHelper::getColumn(AdminMenuEntity::getAllMenu(), 'id');
			$params = [
				'name' => '超级管理员',
				'description' => '超级管理员',
				'permissions' => implode(',', $permissions),
				'is_show' => 1,
				'state' => 1,
			];

			$result = AdminRoleEntity::addRole($params);
			if($result !== false) {
				$this->locker->writeLock($name);
			}
		}
	}

	private function initAdminUser()
	{
		$name = 'admin';
		if(! $this->locker->existsLock($name)) {
			$params = [
				'role_id'    => 1,
				'user_name'  => $name,
				'password'   => 'adminadmin',
				'created_by' => '',
				'modify_by'  => '',
			];

			$result = AdminUserEntity::addUser($params);
			if($result !== false) {
				$this->locker->writeLock($name);
			}
		}
	}
}