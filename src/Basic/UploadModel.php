<?php

namespace Eadmin\Basic;

use yii\base\Model;
use Eadmin\Config;

/**
 * Class UploadModel
 * @package Eadmin\Basic
 */
class UploadModel extends Model
{
    /**
     * @var string
     */
	public $rootPath;

    /**
     * @var string
     */
    public $savePath;

    /**
     * @var string
     */
    public $module = '@backend';

    /**
     * UploadModel constructor.
     */
    public function __construct()
    {
        parent::__construct();

    	$configModule = Config::get('App', 'eadmin_upload_module');
    	if(! empty($configModule)) {
    		$this->module = $configModule;
    	}

    	$this->rootPath = $this->module . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR;

        $this->savePath = 'upload' . DIRECTORY_SEPARATOR;

        return null;
    }
}