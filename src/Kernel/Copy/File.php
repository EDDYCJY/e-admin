<?php

namespace Eadmin\Kernel\Copy;

use Eadmin\Basic\Copy;

class File extends Copy
{
	public function start($lists)
	{
		foreach ($lists as $name) {
			$path = $this->from . self::DS . $name;
			if(! $this->locker->existsLock($name)) {
				if(file_exists($path)) {
					$fileTo = $this->to . self::DS . $name;
					$pathinfo = pathinfo($fileTo, PATHINFO_DIRNAME);
					if(! file_exists($pathinfo)) {
						mkdir($pathinfo, $this->chmod, true);
					}

					if(! copy($path, $fileTo)) {
						echo '222';die;
					} else {
						$this->locker->writeLock($name);
					}
				}
			}
		}
	}
}