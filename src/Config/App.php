<?php
return [
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
	'eadmin_default_hidden_list_display' => [
		'id',
		'password',
		'created_on',
		'modify_on',
		'created_by',
		'modify_by',
	],
	'eadmin_default_hidden_detail_display' => [
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
];