<?php

namespace Eadmin\Kernel\Execute;

use Exception;
use yii\helpers\ArrayHelper;
use Eadmin\Basic\ExecuteLock;
use Eadmin\Constants;

class Crud extends ExecuteLock
{
	public function __construct()
	{
		parent::__construct();

		$this->setLockType(Constants::LOCK_CRUD);
	}

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
			if(! $this->existsLock($index)) {
				$result[$index] = 1;

				$this->writeLock($index);
			}
			
		}

		return $result;
	}

}