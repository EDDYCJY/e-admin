<?php

namespace Eadmin\Command;

use Exception;
use Eadmin\Basic\Command;
use Eadmin\Config;
use Eadmin\Kernel\Support\Container;
use Eadmin\Kernel\Support\FileLock;
use Eadmin\Entity\TableEntity;

/**
 * Class Delete
 * @package Eadmin\Command
 */
class Delete extends Command
{
    /**
     * @var string
     */
	public $params;

    /**
     * Delete constructor.
     *
     * @param  string $params command params
     * @return null
     */
	public function __construct($params)
	{
		$this->params = $params;

		return null;
	}

    /**
     * Delete Start
     *
     * @return bool|null
     */
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

    /**
     * Delete Table
     *
     * @return bool
     */
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

    /**
     * Delete Runtime
     *
     * @return bool
     */
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