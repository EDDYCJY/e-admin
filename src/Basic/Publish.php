<?php

namespace Eadmin\Basic;

use Yii;
use Eadmin\Config;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Kernel\Support\Copy;
use Eadmin\Kernel\Copy\File;
use Eadmin\Kernel\Copy\Catalog;

class Publish
{
	const DS = DIRECTORY_SEPARATOR;

	public $module = '@backend';

	public $path = '';

	public $files = [];

	public $catalogs = [];

	public function __construct()
	{
		$configModule = Config::get('App', 'eadmin_publish_module');
		if(! empty($configModule)) {
			$this->module = $configModule;
		}
	}

	public function start(File $file, Catalog $catalog)
	{
		$file->start($this->files);
		
		$catalog->start($this->catalogs);
	}

	public function getTo()
	{
		return Yii::getAlias($this->module . self::DS . $this->path);
	}

	public function getFrom()
	{
		return dirname(__FILE__) . self::DS . '..' . self::DS . 'Resources' . self::DS . Helpers::getLastIndex(get_called_class());
	}

}