<?php

namespace Eadmin\Kernel\Support;

use Exception;
use Eadmin\Config;

class FileLock
{
	const DS = DIRECTORY_SEPARATOR;

	private $type;

	private $path = '/../../Work/Runtime/%s/';

	public function setType($type)
	{
		$this->type = ucfirst($type);
	}

	public function getPath()
	{
		if($this->checkPath()) {
			return dirname(__FILE__) . sprintf($this->path, $this->type);
		}

		throw new Exception("请在Config/App.php的eadmin_runtime_catalog_configs增加 {$this->type} 配置项！", 1);
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

	public function delete($path) 
	{
	    $handle = dir($path);
	    while(false != ($item = $handle->read())) {
	        if($item == '.' || $item == '..') {
	            continue;
	        }

	        if(is_dir($handle->path . self::DS . $item)) {
	            deleteAll($handle->path . self::DS . $item);
	            rmdir($handle->path . self::DS . $item);
	        } else {
	            unlink($handle->path . self::DS . $item);
	        }
	    
	    }   
	}

	protected function checkPath()
	{
		$result = false;
		if(in_array($this->type, Config::get('App', 'eadmin_runtime_catalog_configs'))) {
			$result = true;
		}

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