<?php

namespace Eadmin\Basic;

use yii\base\Model;
use Eadmin\Config;

class UploadModel extends Model
{
	public $rootPath;

    public $savePath;

    public $module = '@backend';

    public function __construct()
    {
    	$configModule = Config::get('App', 'eadmin_upload_module');
    	if(! empty($configModule)) {
    		$this->module = $configModule;
    	}

    	$this->rootPath = $this->module . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR;

        $this->savePath = 'upload' . DIRECTORY_SEPARATOR;
    }
}