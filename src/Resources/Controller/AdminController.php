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
    public $layout = 'admin';
    
    public $adminId;

    public $adminRoleId;

    public $adminUserName;

    public function init()
    {
        $this->adminId = intval(Yii::$app->session->get('admin_id', 0));

        $this->adminRoleId = intval(Yii::$app->session->get('admin_role_id', 0));
        
        $this->adminUserName = Yii::$app->session->get('admin_user_name');
    }

    public function beforeAction($action)
    {
        $userInfo = AdminUserEntity::getUserInfo($this->adminId, $this->adminUserName);

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