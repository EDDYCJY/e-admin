<?php
namespace backend\widgets;

use Yii;
use backend\models\AdminMenu as AdminMenuModel;

class AdminMenu extends \yii\bootstrap\Widget
{
    public $settings;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $map = [
            'is_show' => 1,
        ];

        $menus = AdminMenuModel::find()->where($map)->all();

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
        

        $params = [
            'menus' => $menus,
        ];

        return $this->render('@backend/widgets/views/admin-menu/index', $params);
    }
}