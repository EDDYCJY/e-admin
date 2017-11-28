<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

/**
 * Class Widget
 * @package Eadmin\Kernel\Publish
 */
class Widget extends Publish
{
	public $path = 'widgets';

	public $files = [
		'AdminMenu.php',
		'AdminNav.php',
	];

	public $catalogs = [
		'views',
	];
}