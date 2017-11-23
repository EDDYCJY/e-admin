<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

class Controller extends Publish
{
	public $path = 'controllers';

	public $files = [
		'LoginController.php',
		'AdminController.php',
		'ErrorController.php',
		'IndexController.php',
	];
}