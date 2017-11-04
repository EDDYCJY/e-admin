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

		while(false  !== ($file = readdir($handle))) {
			$fileFrom = $rootFrom . self::DS . $file;
			$fileTo   = $rootTo   . self::DS . $file;

			if($file == '.' || $file == '..') {		 
				continue;
			}

			if(is_dir($fileFrom)) {
				if(! file_exists($fileTo)) {
					mkdir($fileTo, 0755, true);
				}
				
				$this->recursionFiles($fileFrom, $fileTo);
			} else {
				@copy($fileFrom, $fileTo);
			}
		}

		return true;
	}
}