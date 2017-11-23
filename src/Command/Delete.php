<?php

namespace Eadmin\Command;

use Yii;
use Exception;
use Eadmin\Basic\Command;
use Eadmin\Config;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\FileLock;
use Eadmin\Entity\TableEntity;

class Delete extends Command
{
	public $params;

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function start()
	{
		$tables = array_keys(Container::all());
		$runtimes = Config::get('App', 'eadmin_runtime_catalog_configs');
		
		$result = null;
		if(in_array($this->params, $tables)) {
			$result = $this->table();
		} else {
			if(in_array($this->params, $runtimes)) {
				$result = $this->runtime();
			}
		}

		return $result;
	}

	protected function table()
	{
		try {
			TableEntity::drop($this->params)->execute();
			$this->setSuccess('delete table `' . $this->params . '` success');
			$result = true;
		} catch (Exception $e) {
			$this->setError($e->getMessage());
			$result = false;
		}

		return $result;
	}

	protected function runtime()
	{
		$file = new FileLock();
		$file->setType($this->params);
		$path = $file->getPath();

		try {
			$file->delete($path);
			$this->setSuccess('delete catalog `' . $this->params . '` success');
			$result = true;
		} catch (Exception $e) {
			$this->setError($e->getMessage());
			$result = false;
		}

		return $result;
	}

}