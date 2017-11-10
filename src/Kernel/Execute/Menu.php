<?php

namespace Eadmin\Kernel\Execute;

use Yii;
use Eadmin\Constants;
use Eadmin\Basic\Execute;

class Menu extends Execute
{
	public function start($menu)
	{
		if(! $this->locker->existsLock($menu['name'])) {
			Yii::$app->db->createCommand()->insert('{{%admin_menu}}', $menu)->execute();

			$this->locker->writeLock($menu['name']);
		}
	}

}