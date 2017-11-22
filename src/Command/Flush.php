<?php

namespace Eadmin\Command;

use Yii;
use Exception;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\FileLock;
use Eadmin\Config;

class Flush
{
	private $success = [];

	private $error = [];

	public function table()
	{
		$all = Container::all();
		$tables = array_keys($all);
		foreach ($tables as $table) {
			try {
				Yii::$app->db->createCommand()->dropTable($table)->execute();
				$this->success[] = 'delete table `' . $table . '` success';
			} catch (Exception $e) {
				$this->error[] = $e->getMessage();
			}
		}

		return true;
	}

	public function runtime()
	{
		$paths = [];
		$file  = new FileLock();
		
		$runtimes = Config::get('App', 'eadmin_runtime_catalog_configs');
		foreach ($runtimes as $catalog) {
			$file->setType($catalog);
			$paths[$catalog] = $file->getPath();
		}

		foreach ($paths as $catalog => $path) {
			try {
				$file->delete($path);
				$this->success[] = 'flush catalog `' . $catalog . '` success';
			} catch (Exception $e) {
				$this->error[] = $e->getMessage();
			}
		}

		return true;
	}

	public function getSuccess()
	{
		return $this->success;
	}

	public function getError()
	{
		return $this->error;
	}


}