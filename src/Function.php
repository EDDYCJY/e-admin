<?php

function getAdminUserName() {
	return \Yii::$app->session->get('admin_user_name');
}