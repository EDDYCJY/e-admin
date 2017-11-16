<?php
namespace backend\widgets;

use Yii;
use backend\models\AdminMenu as AdminMenuModel;
use Eadmin\Entity\AdminMenuEntity;

class AdminMenu extends \yii\bootstrap\Widget
{
    public $settings;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $menus = AdminMenuEntity::getMenus();
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
        ];

        return $this->render('@backend/widgets/views/admin-menu/index', $params);
    }
}