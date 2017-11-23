<?php

namespace Eadmin\Kernel\Publish;

use Eadmin\Basic\Publish;

class Model extends Publish
{
	public $path = 'models';

	public $files = [
		'UploadForm.php',
		'UploadsForm.php',
	];
}