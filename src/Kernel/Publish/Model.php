<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

/**
 * Class Model
 * @package Eadmin\Kernel\Publish
 */
class Model extends Publish
{
	public $path = 'models';

	public $files = [
		'UploadForm.php',
		'UploadsForm.php',
	];
}