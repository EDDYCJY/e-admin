<?php

namespace Eadmin\Basic;

use Yii;
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
        
    	$this->rootPath = Yii::getAlias($this->module) . Config::get('App', 'eadmin_upload_root_path');

        $this->savePath = Config::get('App', 'eadmin_upload_save_path');

        return null;
    }
}