<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

/**
 * Class Controller
 * @package Eadmin\Kernel\Publish
 */
class Controller extends Publish
{
	public $path = 'controllers';

	public $files = [
		'LoginController.php',
		'AdminController.php',
		'ErrorController.php',
		'IndexController.php',
		'AdminUserController.php',
	];
}