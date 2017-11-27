<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use Eadmin\Basic\UploadModel;
use yii\web\UploadedFile;
use backend\models\Upload;

/**
* UploadForm is the model behind the upload form.
*/
class UploadForm extends UploadModel
{
    public $file;

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
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
        	$uploadPath   = $this->savePath . $this->getFileName($this->file->baseName) . '.' . $this->file->extension;

            if(! file_exists($this->rootPath . $this->savePath)) {
                mkdir($this->rootPath . $this->savePath, 0755, true);
            }

            $uploadResult = $this->file->saveAs($this->rootPath . $uploadPath);

            $model = new Upload();
            $model->url = $uploadPath;

            if($model->save() !== false) {
            	return $model->id;
            }
        }

        return false;
    }
}