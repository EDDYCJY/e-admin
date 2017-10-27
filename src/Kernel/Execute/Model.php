<?php

namespace Eadmin\Kernel\Execute;

use Exception;
use Eadmin\Constants;
use Eadmin\Basic\ExecuteLock;

class Model extends ExecuteLock
{
	public function __construct()
	{
		parent::__construct();

		$this->setLockType(Constants::LOCK_MODEL);
	}

	public function start($generator)
	{
		$files = $generator->generate();
		$id = $files[0]->id;
		$answers = [
			$id => 1
		];

		if(! $this->existsLock($id)) {
			if(! empty($answers)) {
				try {
					$generator->save($files, $answers, $results);
					
					$this->writeLock($id);

				} catch (Exception $e) {
					echo $e->getMessage();die;
				}
			}
		}

	}
}