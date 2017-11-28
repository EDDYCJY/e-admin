<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\AdminUser;
use Eadmin\Config;
use Eadmin\Entity\AdminRoleEntity;
use Eadmin\Entity\AdminMenuEntity;

class LoginController extends Controller
{
    public $layout = false;

    public function actionIndex() 
    {
        $model = new AdminUser();
        $returnUrl = Config::get('Setting', 'site_login_return_url');

        if ($model->load(Yii::$app->request->post())) {
            $map = [
                'user_name' => $model->user_name,
                'state' => 1,
            ];
            $userInfo = $model->findOne($map);
            if($userInfo['password'] === md5($model->password)) {
                Yii::$app->session->set('admin_id', $userInfo['id']);
                Yii::$app->session->set('admin_user_name', $userInfo['user_name']);
                Yii::$app->session->set('admin_created_on', date('Y-m-d', $userInfo['created_on']));

                return $this->redirect([$returnUrl]);
            } else {
                $model->addErrors([
                    'user_name' => '',
                    'password'  => '账号或密码错误。',
                ]);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->session->remove('admin_id');
        Yii::$app->session->remove('admin_user_name');

        return $this->redirect(['login/index']);
    }


}