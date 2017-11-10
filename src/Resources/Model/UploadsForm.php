<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use backend\models\Upload;
use Yii;

/**
* UploadsForm is the model behind the upload form.
*/
class UploadsForm extends Model
{
    /**
    * @var UploadedFile file attribute
    */
    public $files;

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