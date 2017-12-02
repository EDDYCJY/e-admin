<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

/**
 * Class Adminlte
 * @package Eadmin\Kernel\Publish
 */
class Adminlte extends Publish
{
	public $path = 'web/static';

	public $catalogs = [
		'bower_components',
		'dist',
		'plugins',
		'eadmin',
	];
}