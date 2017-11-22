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
			$result = $command->execute(); //$this->objecter->getTabler()->executeCommand($command);
			if($result === false) {
				return false;
			}

			$this->locker->writeLock($key);
		}

		return true;
	}
}