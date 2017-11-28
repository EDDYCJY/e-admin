<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

/**
 * Class Asset
 * @package Eadmin\Kernel\Publish
 */
class Asset extends Publish
{
	public $path = 'assets';

	public $files = [
		'AdminAsset.php',
	];

}