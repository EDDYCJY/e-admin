<?php

namespace backend\controllers;

use Yii;
use backend\controllers\AdminController;

class ErrorController extends AdminController
{
	public $layout = 'admin';

	public function actionIndex()
	{
		$exception = Yii::$app->errorHandler->exception;

		return $this->render('index', ['exception' => $exception]);
	}
}