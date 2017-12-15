<?php

namespace Eadmin\Entity;

use Eadmin\Config;
use backend\models\Upload;

/**
 * Class UploadEntity
 * @package Eadmin\Entity
 */
class UploadEntity extends Upload
{
    /**
     * Get Full Image Url
     *
     * @param  int $id image_id
     * @return string
     */
	public static function getFullUrl($id)
	{
		$url = self::find()->where(['id' => $id])->select('url')->scalar();

		$result = '';
		if(! empty($url)) {
			$result = Config::get('Setting', 'image_url_prefix') . DIRECTORY_SEPARATOR . $url;
		}

		return $result;
	}
}