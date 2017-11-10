<?php

namespace Eadmin\Kernel\Copy;

use Eadmin\Basic\Copy;

class Catalog extends Copy
{
	public function start($lists)
	{
		foreach ($lists as $name) {
			if(! $this->locker->existsLock($name)) {
				$path = $this->from . self::DS . $name;
				if(file_exists($path)) {
					if(! $this->recursionFiles($path, $this->to . self::DS . $name)) {
						echo '333';die;
					} else {
						$this->locker->writeLock($name);
					}
				}
			}
		}
	}

	private function recursionFiles($rootFrom, $rootTo) 
	{
		$handle = opendir($rootFrom);

		$result = true;
		while(false  !== ($file = readdir($handle))) {
			$fileFrom = $rootFrom . self::DS . $file;
			$fileTo   = $rootTo   . self::DS . $file;

			if($file == '.' || $file == '..') {		 
				continue;
			}

			$pathinfo = pathinfo($fileTo, PATHINFO_DIRNAME);
			if(! file_exists($pathinfo)) {
				mkdir($pathinfo, $this->chmod, true);
			}

			if(is_dir($fileFrom)) {
				$this->recursionFiles($fileFrom, $fileTo);
			} else {
				$result = copy($fileFrom, $fileTo);
			}
		}

		return $result;
	}
}