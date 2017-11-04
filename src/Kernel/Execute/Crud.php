<?php

namespace Eadmin\Kernel\Execute;

use Exception;
use yii\helpers\ArrayHelper;
use Eadmin\Constants;
use Eadmin\Basic\Execute;

class Crud extends Execute
{
	public function start($generator)
	{
		$files   = $generator->generate();
		$answers = $this->setAnswers($files);
		if(! empty($answers)) {
			try {
				$generator->save($files, $answers, $results);
			} catch (Exception $e) {
				echo $e->getMessage();die;
			}
		}
	}

	private function setAnswers($files)
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