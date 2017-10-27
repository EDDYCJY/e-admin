<?php

namespace Eadmin\Kernel\Contracts;

interface ExecuteInterface
{
	public function getLockName($key);

	public function existsLock($key);

	public function writeLock($key);
}