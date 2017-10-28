<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

class Adminlte extends Publish
{
	public $module = '@backend';

	public $path = 'web/static';

	public $catalogs = [
		'bower_components',
		'dist',
		'plugins'
	];
}