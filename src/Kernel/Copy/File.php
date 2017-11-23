<?php

namespace Eadmin\Kernel\Copy;

use Eadmin\Basic\Copy;
use Eadmin\Command\Output;

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
						$object = new Output();
						echo $object->setError('Eadmin\Kernel\Copy\File is Wrong')->getErrorMsg();
						$object->close();
					} else {
						$this->locker->writeLock($name);
					}
				}
			}
		}
	}
}