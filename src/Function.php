<?php

/**
 * Get Admin-Session UserName
 *
 * @return string
 */
function getAdminUserName() {
	return \Yii::$app->session->get('admin_user_name');
}