<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use Eadmin\Entity\AdminUserEntity;
use Eadmin\Entity\AdminRoleEntity;
use Eadmin\Entity\AdminMenuEntity;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        $userInfo = AdminUserEntity::getUserInfo(Yii::$app->session->get('admin_id'), Yii::$app->session->get('admin_user_name'));

        $result = false;
        if(! empty($userInfo)) {
            $roleInfo = AdminRoleEntity::getRoleInfo($userInfo['role_id']);
            if(! empty($roleInfo)) {
                $requestedRoute = Yii::$app->requestedRoute;
                $menus = AdminMenuEntity::getMenus($roleInfo['permissions']);

                if(! empty($menus)) {
                    $allMenu = AdminMenuEntity::getAllMenu();
                    $allUrls = ArrayHelper::getColumn($allMenu, 'url');
                    if(! in_array($requestedRoute, $allUrls)) {
                        $result = true;
                    } else {
                        foreach ($menus as $key => $value) {
                            if($value['url'] == $requestedRoute) {
                                $result = true;
                                break;
                            }
                        }
                    }
                } 
            }

            if($result === false) {
                return false;
            }

        } else {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('login/index'));
        }

        return true;
    }

}