<?php

namespace Eadmin\Kernel\Extra;

use Eadmin\Basic\Extra;
use backend\models\AdminUser;

class Admin extends Extra
{
	public function start()
	{
		$this->initAdminUser();
	}

	private function initAdminUser()
	{
		$userName = 'admin';
		if(! $this->locker->existsLock($userName)) {
			$model = new AdminUser();
			$model->user_name  = $userName;
			$model->password   = 'f6fdffe48c908deb0f4c3bd36c032e72';
			$model->created_on = time();
			$model->created_by = 'eadmin';
			$model->save();

			$this->locker->writeLock($userName);
		}
	}
}