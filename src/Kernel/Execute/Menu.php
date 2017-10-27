<?php

namespace Eadmin\Kernel\Execute;

use Yii;
use Eadmin\Constants;
use Eadmin\Basic\ExecuteLock;

class Menu extends ExecuteLock
{
	public function __construct()
	{
		parent::__construct();

		$this->setLockType(Constants::LOCK_MENU);
	}

	public function start($menu)
	{
		if(! $this->existsLock($menu['name'])) {
			Yii::$app->db->createCommand()->insert('{{%admin_menu}}', $menu)->execute();

			$this->writeLock($menu['name']);
		}
	}

	public function getLockName($key)
	{
		return md5($key) . '.' . Constants::LOCK_FLAG;
	}

}