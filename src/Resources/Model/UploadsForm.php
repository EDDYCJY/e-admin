<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use Eadmin\Basic\UploadModel;
use backend\models\Upload;

/**
* UploadsForm is the model behind the upload form.
*/
class UploadsForm extends UploadModel
{
    /**
    * @var UploadedFile file attribute
    */
    public $files;

    public function getFileName($baseName)
    {
        return md5($baseName);
    }

    /**
    * @return array the validation rules.
    */
    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg', 'maxFiles' => 10 ],
        ];
    }

    public function upload()
    {
    	$lists = [];
        if ($this->validate()) {
        	foreach ($this->files as $file) {
        		$uploadPath   = $this->savePath . $this->getFileName($file->baseName) . '.' . $file->extension;

                if(! file_exists($this->rootPath . $this->savePath)) {
                    mkdir($this->rootPath . $this->savePath, 0755, true);
                }

                $uploadResult = $file->saveAs($this->rootPath . $uploadPath);

                $model = new Upload();
                $model->url = $uploadPath;

                if($model->save() !== false) {
                	 $lists[] = $model->id;
                }
            }

            return $lists;
        }

        return false;
    }
}