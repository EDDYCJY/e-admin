<?php

/**
 * Get Admin-Session UserName
 *
 * @return string
 */

if(! function_exists('getAdminUserName')) {
	function getAdminUserName() {
		return \Yii::$app->session->get('admin_user_name');
	}
}

