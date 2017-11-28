<?php

namespace Eadmin\Basic;

use Yii;
use Eadmin\Config;
use Eadmin\Kernel\Support\Helpers;
use Eadmin\Kernel\Copy\File;
use Eadmin\Kernel\Copy\Catalog;

/**
 * Class Publish
 * @package Eadmin\Basic
 */
class Publish
{
	const DS = DIRECTORY_SEPARATOR;

    /**
     * @var string
     */
	public $module = '@backend';

    /**
     * @var string
     */
	public $path = '';

    /**
     * @var array
     */
	public $files = [];

    /**
     * @var array
     */
	public $catalogs = [];

    /**
     * Publish constructor.
     */
	public function __construct()
	{
		$configModule = Config::get('App', 'eadmin_publish_module');
		if(! empty($configModule)) {
			$this->module = $configModule;
		}
	}

    /**
     * Start Publish
     *
     * @param File $file
     * @param Catalog $catalog
     * @return null
     */
	public function start(File $file, Catalog $catalog)
	{
		$file->start($this->files);
		
		$catalog->start($this->catalogs);

		return null;
	}

    /**
     * Get Destination To
     *
     * @return bool|string
     */
	public function getTo()
	{
		return Yii::getAlias($this->module . self::DS . $this->path);
	}

    /**
     * Get Source From
     *
     * @return string
     */
	public function getFrom()
	{
		return dirname(__FILE__) . self::DS . '..' . self::DS . 'Resources' . self::DS . Helpers::getLastIndex(get_called_class());
	}

}