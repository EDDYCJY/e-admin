<?php

namespace Eadmin\Kernel\Copy;

use Eadmin\Basic\Copy;

class File extends Copy
{
	public function start($lists)
	{
		foreach ($lists as $name) {
			$path = $this->from . self::DS . $name;
			if(file_exists($path)) {
				if(! copy($path, $this->to . self::DS . $name)) {
					echo '222';die;
				}
			}
		}
	}
}