<?php

namespace Eadmin\Kernel\Contracts;

interface LockInterface
{
	public function getLockName($key);

	public function existsLock($key);

	public function writeLock($key);
}