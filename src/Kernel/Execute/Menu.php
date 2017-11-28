<?php

namespace Eadmin\Kernel\Execute;

use Yii;
use Eadmin\Constants;
use Eadmin\Basic\Execute;
use Eadmin\Entity\AdminMenuEntity;

/**
 * Class Menu
 * @package Eadmin\Kernel\Execute
 */
class Menu extends Execute
{
	public function start($menu)
	{
		if(! $this->locker->existsLock($menu['menu_name']) && AdminMenuEntity::addMenu($menu) !== false) {
            $this->locker->writeLock($menu['menu_name']);
		}
	}

}