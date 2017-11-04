<?php

namespace Eadmin\Kernel\Execute;

use Exception;
use Eadmin\Constants;
use Eadmin\Basic\Execute;

class Model extends Execute
{
	public function start($generator)
	{
		$files = $generator->generate();
		$id = $files[0]->id;
		$answers = [
			$id => 1
		];

		if(! $this->locker->existsLock($id)) {
			if(! empty($answers)) {
				try {
					$generator->save($files, $answers, $results);
					
					$this->locker->writeLock($id);

				} catch (Exception $e) {
					echo $e->getMessage();die;
				}
			}
		}

	}
}