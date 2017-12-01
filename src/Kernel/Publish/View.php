<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

/**
 * Class View
 * @package Eadmin\Kernel\Publish
 */
class View extends Publish
{
	public $path = 'views';

	public $catalogs = [
		'layouts',
		'login',
		'error',
		'index',
		'admin-menu',
	];
}