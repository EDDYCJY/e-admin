<?php

namespace Eadmin\Kernel\Contracts;

/**
 * Interface LockInterface
 * @package Eadmin\Kernel\Contracts
 */
interface LockInterface
{
	public function getLockName($key);

	public function existsLock($key);

	public function writeLock($key);
}