<?php
return [
	'eadmin_generator_enable' => [
		'table' => true,
		'model' => true,
		'menu'  => true,
		'crud'  => true,
	],
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
	'eadmin_model_options_configs' => [
		'export' => [
            'fileName' => 'eadmin-export',
            'fileFormat' => 'Excel5', 
            'field' => [],
        ],
	],
	'eadmin_upload_module' => '@backend',
	'eadmin_publish_module' => '@backend',
	'eadmin_split_fields' => [
		'permissions',
	],
	'eadmin_hidden_list_display' => [
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
		'Adminlte',
	],
];