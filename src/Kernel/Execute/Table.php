<?php

namespace Eadmin\Kernel\Execute;

use Eadmin\Basic\Execute;

/**
 * Class Table
 * @package Eadmin\Kernel\Execute
 */
class Table extends Execute
{
	public function start($command)
	{
		$key = $this->objecter->getTabler()->getTableFullName();
		if(! $this->locker->existsLock($key) && $command->execute() !== false) {
            $this->locker->writeLock($key);
		}

		return true;
	}
}