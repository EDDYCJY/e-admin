<?php

namespace Eadmin\Basic;

use Eadmin\Constants;
use Eadmin\Kernel\Support\Lock;
use Eadmin\Kernel\Contracts\ExecuteInterface;

class ExecuteLock implements ExecuteInterface
{
	public $lock;

	public function __construct()
	{
		$this->lock = new Lock();
	}

	public function setLockType($type)
	{
		$this->lock->setType($type);

		return true;
	}

	public function getLockName($key)
	{
		return $key . '.' . Constants::LOCK_FLAG;;
	}

	public function existsLock($key)
	{
		return $this->lock->exists($this->getLockName($key));
	}

	public function writeLock($key)
	{
		return $this->lock->write($this->getLockName($key));
	}

}