<?php

namespace Eadmin\Basic;

use Eadmin\Constants;
use Eadmin\Kernel\Support\FileLock;
use Eadmin\Kernel\Contracts\LockInterface;

class Lock implements LockInterface
{
	public $lock;

	public function __construct($type)
	{
		$this->lock = new FileLock();
		$this->lock->setType($type);
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