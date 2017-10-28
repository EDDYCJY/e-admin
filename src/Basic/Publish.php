<?php

namespace Eadmin\Basic;

use Yii;
use Eadmin\Kernel\Support\Helpers;

class Publish
{
	const DS = DIRECTORY_SEPARATOR;

	public $module = '@backend';

	public $path = '';

	public $files = [];

	public $catalogs = [];

	public function __construct()
	{
		$name = Helpers::getLastIndex(get_called_class());

		$filePath = dirname(__FILE__);
		$resourcePath = $filePath . self::DS . '..' . self::DS . 'Resources' . self::DS . $name;	
		$appPath = Yii::getAlias($this->module . self::DS . $this->path);

		if(! empty($this->files)) {
			foreach ($this->files as $key => $value) {
				$resourceFilePath = $resourcePath . self::DS . $value;
				if(file_exists($resourceFilePath)) {
					$appFilePath = $appPath . self::DS . $value;
					if(! copy($resourceFilePath, $appFilePath)) {
						echo '222';die;
					}
				}
			}
		}

		if(! empty($this->catalogs)) {
			foreach ($this->catalogs as $key => $value) {
				$resourceCataLogPath = $resourcePath . self::DS . $value;
				if(file_exists($resourceCataLogPath)) {
					$appCataLogPath = $appPath . self::DS . $value;
					if(! $this->cp_files($resourceCataLogPath, $appCataLogPath)) {
						echo '333';die;
					}
				}
			}
		}

	}

	public function start()
	{

	}

	public function cp_files($rootFrom,$rootTo){
		$handle=opendir($rootFrom);
		while(false  !== ($file = readdir($handle))){
			//DIRECTORY_SEPARATOR 为系统的文件夹名称的分隔符 例如：windos为'/'; linux为'/'
			$fileFrom=$rootFrom.DIRECTORY_SEPARATOR.$file;
			$fileTo=$rootTo.DIRECTORY_SEPARATOR.$file;
			if($file=='.' || $file=='..'){		 continue;}
			if(is_dir($fileFrom)){
				if(! file_exists($fileTo)) {
					mkdir($fileTo,0777,true);
				}
				
				$this->cp_files($fileFrom,$fileTo);
			}else{
				@copy($fileFrom,$fileTo);
			}
		}

		return true;
	}

}