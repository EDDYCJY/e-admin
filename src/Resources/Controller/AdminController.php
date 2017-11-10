<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use backend\models\AdminUser;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        $model = new AdminUser();
        $map = [
            'id' => Yii::$app->session->get('admin_id'),
            'user_name' => Yii::$app->session->get('admin_user_name'),
            'state' => 1,
        ];
        $userInfo = $model->findOne($map);
        if(empty($userInfo)) {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('login/index'));
        }

        return true;
    }

}