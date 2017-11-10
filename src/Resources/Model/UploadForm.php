<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\Upload;
use Yii;

/**
* UploadForm is the model behind the upload form.
*/
class UploadForm extends Model
{
    public $file;

    public $rootPath;

    public $savePath;

    public function __construct()
    {
    	$this->rootPath = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR;

        $this->savePath = 'upload' . DIRECTORY_SEPARATOR;
    }

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