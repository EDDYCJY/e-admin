<?php
return [
	'eadmin_origin_admin_configs' => [
		'user_name' => 'admin',
		'password'  => 'adminadmin',
		'role_name' => '超级管理员',
		'role_description' => '超级管理员'
	],
	'eadmin_generator_configs' => [
		'crud' => [
			'namespace' => [
				'model' => 'backend\models',
				'controller' => 'backend\controllers',
				'view' => '@backend/views',
			],
			'searchClassSuffix' => 'Search',
			'controllerClassSuffix' => 'Controller',
		],
		'model' => [
			'namespace' => 'backend\models',
			'queryClassSuffix' => 'Query',
		],
	],
	'eadmin_upload_module' => '@backend',
	'eadmin_publish_module' => '@backend',
	'eadmin_split_fields' => [
		'permissions',
	],
	'eadmin_list_fields' => [
		'state' 	 => \Eadmin\Expand\View\StateField::class,
		'is_show'    => \Eadmin\Expand\View\RadioListField::class,
		'type'       => \Eadmin\Expand\View\RadioListField::class,
		'created_on' => \Eadmin\Expand\View\DateField::class,
		'modify_on'  => \Eadmin\Expand\View\DateField::class,
	],
	'eadmin_hidden_list_display' => [
		'id',
		'password',
		'created_on',
		'modify_on',
		'created_by',
		'modify_by',
	],
	'eadmin_hidden_detail_display' => [
		'created_on',
		'modify_on',
		'created_by',
		'modify_by',
	],
	'eadmin_encrypt_function_fields' => [
		'password' => 'md5',
	],
	'eadmin_time_function_insert_fields' => [
		'created_on' => 'time',	
		'created_by' => "getAdminUserName",
	],
	'eadmin_time_function_update_fields' => [
		'modify_on' => 'time',
		'modify_by' => "getAdminUserName",
	],
	'eadmin_runtime_catalog_configs' => [
		'Admin',
		'Asset',
		'Controller',
		'Crud',
		'Menu',
		'Model',
		'Table',
		'View',
		'Widget',
	],
];