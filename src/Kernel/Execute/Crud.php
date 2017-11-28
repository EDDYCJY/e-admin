<?php

namespace Eadmin\Kernel\Execute;

use yii\helpers\ArrayHelper;
use Eadmin\Constants;
use Eadmin\Basic\Execute;
use Eadmin\Exception\ExecuteException;
use Eadmin\Command\Output;

/**
 * Class Crud
 * @package Eadmin\Kernel\Execute
 */
class Crud extends Execute
{
	public function start($generator)
	{
		$files   = $generator->generate();
		$answers = $this->getAnswers($files);
		if(! empty($answers)) {
			try {
				$generator->save($files, $answers, $results);
			} catch (ExecuteException $e) {
				$object = new Output();
				echo $object->setError($e->getMessage())->getErrorMsg();
				$object->close();
			}
		}
	}

	private function getAnswers($files)
	{
		$result = [];
		foreach (ArrayHelper::index($files, 'id') as $index => $value) {
			if(! $this->locker->existsLock($index)) {
				$result[$index] = 1;
				$this->locker->writeLock($index);
			}
			
		}

		return $result;
	}

}