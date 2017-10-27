<?php

namespace Eadmin\Kernel\Execute;

use Eadmin\Basic\ExecuteLock;
use Eadmin\Constants;

class Table extends ExecuteLock
{
	public $objecter;

	public function __construct($object)
	{
		parent::__construct();
		
		$this->setLockType(Constants::LOCK_TABLE);

		$this->objecter = $object;
	}

	public function start($command)
	{
		$key = $this->objecter->tabler->getTableFullName();
		if(! $this->existsLock($key)) {
			$result = $this->objecter->tabler->executeCreateTable($command);
			if($result === false) {
				return false;
			}

			$this->writeLock($key);
		}

		return true;
	}
}