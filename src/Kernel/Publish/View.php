<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

class View extends Publish
{
	public $module = '@backend';

	public $path = 'views';

	public $catalogs = [
		'layouts',
		'login',
	];
}