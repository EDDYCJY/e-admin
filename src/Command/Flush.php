<?php

namespace Eadmin\Command;

use Exception;
use Eadmin\Basic\Command;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\FileLock;
use Eadmin\Config;
use Eadmin\Entity\TableEntity;

/**
 * Class Flush
 * @package Eadmin\Command
 */
class Flush extends Command
{
    /**
     * Flush Table
     *
     * @return bool
     */
	public function table()
	{
		$all = Container::all();
		$tables = array_keys($all);
		foreach ($tables as $tableName) {
			try {
				TableEntity::drop($tableName)->execute();
				$this->setSuccess('delete table `' . $tableName . '` success');
			} catch (Exception $e) {
				$this->setError($e->getMessage());
			}
		}

		return true;
	}

    /**
     * Flush Runtime
     *
     * @return bool
     */
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
				$this->setSuccess('flush catalog `' . $catalog . '` success');
			} catch (Exception $e) {
				$this->setError($e->getMessage());
			}
		}

		return true;
	}
}