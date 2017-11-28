<?php

namespace Eadmin\Kernel\Extra;

use yii\helpers\ArrayHelper;
use Eadmin\Config;
use Eadmin\Basic\Extra;
use Eadmin\Entity\AdminUserEntity;
use Eadmin\Entity\AdminMenuEntity;
use Eadmin\Entity\AdminRoleEntity;

class Admin extends Extra
{
	public $userName = 'admin';

	public $password = 'adminadmin';

	public $roleName = '超级管理员';

	public $roleDescription = '超级管理员';

	public function start()
	{
		$this->initConfigs();
		$this->initAdminRole();
		$this->initAdminUser();
	}

	private function initConfigs()
	{
		$configs = Config::get('App', 'eadmin_origin_admin_configs');
		if(! empty($configs['user_name'])) {
			$this->userName = $configs['user_name'];
		}
		if(! empty($configs['password'])) {
			$this->password = $configs['password'];
		}
		if(! empty($configs['role_name'])) {
			$this->roleName = $configs['role_name'];
		}
		if(! empty($configs['role_description'])) {
			$this->roleDescription = $configs['role_description'];
		}
	}

	private function initAdminRole()
	{
		$name = 'admin_role';
		if(! $this->locker->existsLock($name)) {
			$permissions = ArrayHelper::getColumn(AdminMenuEntity::getAllMenu(), 'id');
			$params = [
				'role_name' => $this->roleName,
				'description' => $this->roleDescription,
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
				'user_name'  => $this->userName,
				'password'   => $this->password,
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