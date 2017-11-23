<?php

namespace Eadmin\Kernel\Execute;

use Eadmin\Constants;
use Eadmin\Basic\Execute;
use Eadmin\Exception\ExecuteException;
use Eadmin\Command\Output;

class Model extends Execute
{
	public function start($generator)
	{
		$files = $generator->generate();
		$id = $this->getId($files);
		$answers = $this->getAnswers($files);

		if(! $this->locker->existsLock($id)) {
			if(! empty($answers)) {
				try {
					$generator->save($files, $answers, $results);
					$this->locker->writeLock($id);
				} catch (ExecuteException $e) {
					$object = new Output();
					echo $object->setError($e->getMessage())->getErrorMsg();
					$object->close();
				}
			}
		}
	}

	private function getId($files)
	{
		return $files[0]->id;
	}

	private function getAnswers($files)
	{
		$answers = [
			$this->getId($files) => 1
		];

		return $answers;
	}
}