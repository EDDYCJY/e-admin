<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use Eadmin\Config;
use Eadmin\Entity\AdminUserEntity;
use Eadmin\Entity\AdminRoleEntity;
use Eadmin\Entity\AdminMenuEntity;

class AdminController extends Controller
{
    public $layout = 'admin';
    
    public $adminId;

    public $superRoleId;

    public $adminRoleId;

    public $adminUserName;

    public function beforeAction($action)
    {
        $this->initParams();

        $this->initAdmin();

        return true;
    }

    protected function initParams()
    {
        $this->adminId = intval(Yii::$app->session->get('admin_id', 0));

        $this->adminRoleId = intval(Yii::$app->session->get('admin_role_id', 0));
        
        $this->adminUserName = Yii::$app->session->get('admin_user_name');

        $this->superRoleId = intval(Config::get('App', 'eadmin_super_role_id'));
    }

    protected function initAdmin()
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

            if($this->adminRoleId !== $this->superRoleId) {
                if($result === false && Yii::$app->getErrorHandler()->exception === null) {
                    throw new UnauthorizedHttpException("Permission denied");
                }
            }

        } else {
            $this->redirect(Yii::$app->urlManager->createAbsoluteUrl('login/index'));
        }
    }
    
}