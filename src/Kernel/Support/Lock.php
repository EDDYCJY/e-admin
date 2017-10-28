<?php

namespace Eadmin\Kernel\Support;

use Exception;

class Lock
{
	private $type;

	private $maps = [
		'crud'  => '/../../Work/Runtime/Crud/',
		'model' => '/../../Work/Runtime/Model/',
		'table' => '/../../Work/Runtime/Table/',
		'menu'  => '/../../Work/Runtime/Menu/',
	];

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getPath()
	{
		$result = '';
		if(isset($this->maps[$this->type])) {
			$result = dirname(__FILE__) . $this->maps[$this->type];
		}

		return $result;
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