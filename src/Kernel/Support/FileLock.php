<?php

namespace Eadmin\Kernel\Support;

use Exception;

class FileLock
{
	private $type;

	private $path = '/../../Work/Runtime/%s/';

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getPath()
	{
		return dirname(__FILE__) . sprintf($this->path, ucfirst($this->type));
	}

	public function exists($filename)
	{
		$result = false;
		if(file_exists($this->getPath() . $filename)) {
			$result = true;
		}

		return $result;
	}

	public function write($filename, $mode = 'w')
	{
		$result = true;

		$this->mkdir();
		
		$file = fopen($this->getPath() . $filename, $mode);

		try {
			fwrite($file, 1);
		} catch (Exception $e) {
			$result = false;
		}

		fclose($file);

		return $result;
	}

	protected function mkdir()
	{
		$path = $this->getPath();
		if(! file_exists($path)) {
			try {
				mkdir($path, 0755, true);
			} catch (Exception $e) {
				throw new Exception("创建目录（ {$path} ）失败！");
			}
		}

		return true;
	}

}