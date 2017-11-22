<?php

namespace Eadmin\Entity;

use Eadmin\Config;
use backend\models\Upload;

class UploadEntity extends Upload
{
	public static function getFullUrl($id)
	{
		$url = self::find()->where(['id' => $id])->select('url')->scalar();

		$result = '';
		if(! empty($url)) {
			$result = Config::get('Setting', 'image_url_prefix') . $url;
		}

		return $result;
	}
}