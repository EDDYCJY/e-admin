<?php
namespace common\widgets;

use Yii;

class AdminMenu extends \yii\bootstrap\Widget
{
	public $settings;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $menus = Yii::$app->db->createCommand('SELECT * FROM {{%admin_menu}}')->queryAll();

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

        return $this->render('@common/widgets/views/admin-menu/index', $params);
    }
}