<?php
namespace backend\widgets;

use Yii;

class AdminNav extends \yii\bootstrap\Widget
{
	public function init()
    {
        parent::init();
    }

    public function run()
    {
    	return $this->render('@backend/widgets/views/admin-nav/index');
    }

}