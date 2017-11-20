<?php

namespace backend\controllers;

use backend\controllers\AdminController;

class IndexController extends AdminController
{
	public $layout = 'admin';

	public function actionIndex()
	{
		return $this->render('index');
	}

}