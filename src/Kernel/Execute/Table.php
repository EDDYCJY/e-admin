<?php

namespace Eadmin\Kernel\Execute;

use Eadmin\Constants;
use Eadmin\Basic\Execute;

class Table extends Execute
{
	public function start($command)
	{
		$key = $this->objecter->getTabler()->getTableFullName();
		if(! $this->locker->existsLock($key)) {
			if($command->execute() !== false) {
				$this->locker->writeLock($key);
			}
		}

		return true;
	}
}