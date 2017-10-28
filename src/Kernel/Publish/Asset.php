<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

class Asset extends Publish
{
	public $module = '@backend';

	public $path = 'assets';

	public $files = [
		'AdminAsset.php',
	];

}