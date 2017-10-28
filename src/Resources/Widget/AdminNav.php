<?php
namespace common\widgets;

use Yii;

class AdminNav extends \yii\bootstrap\Widget
{
	public function init()
    {
        parent::init();
    }

    public function run()
    {
    	return $this->render('@common/widgets/views/admin-nav/index');
    }

}