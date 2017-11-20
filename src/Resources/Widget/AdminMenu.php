<?php
namespace backend\widgets;

use Yii;
use Eadmin\Entity\AdminMenuEntity;
use Eadmin\Entity\AdminUserEntity;
use Eadmin\Entity\AdminRoleEntity;
use Eadmin\Config;

class AdminMenu extends \yii\bootstrap\Widget
{
    public $settings;

    public function init()
    {
        parent::init();
    }

    private function getAdminMenus()
    {
        $userInfo = AdminUserEntity::getUserInfo(Yii::$app->session->get('admin_id'), Yii::$app->session->get('admin_user_name'));
        $roleInfo = AdminRoleEntity::getRoleInfo($userInfo['id']);

        $result = [];
        if(! empty($roleInfo)) {
            $result = AdminMenuEntity::getMenus($roleInfo['permissions']);
        }

        return $result;
    }

    public function run()
    {
        $menus = $this->getAdminMenus();
        $requestedRoute = Yii::$app->requestedRoute;

        $childrens = [];
        foreach ($menus as $key => $value) {
            if($value['parent_id'] > 0) {
                $childrens[] = $value;
                unset($menus[$key]);
            }
        }

        if(! empty($childrens)) {
            foreach ($childrens as $children) {
                foreach ($menus as $key => $menu) {
                    if($children['parent_id'] == $menu['id']) {
                        $menus[$key]['childrens'][] = $children;
                    }
                }
            }
        }

        foreach ($menus as $key => $value) {
            $menus[$key]['class'] = '';
            if($requestedRoute == $value['url']) {
                $menus[$key]['class'] .= ' active'; 
            }

            if(! empty($value['childrens'])) {
                $menus[$key]['class'] .= ' treeview';
                foreach ($value['childrens'] as $index => $children) {
                    if($requestedRoute == $children['url']) {
                        $menus[$key]['class'] .= ' active menu-open';
                        $menus[$key]['childrens'][$index]['class'] = ' active';
                    } else {
                        $menus[$key]['childrens'][$index]['class'] = '';
                    }
                }
            }
        }

        $params = [
            'menus' => $menus,
            'menuIconPrefix' => trim(Config::get('Setting', 'site_menu_icon_prefix'), ' '),
        ];

        return $this->render('@backend/widgets/views/admin-menu/index', $params);
    }
}