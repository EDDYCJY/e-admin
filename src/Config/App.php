<?php
return [
	'eadmin_split_fields' => [
		\Eadmin\Constants::PERMISSION_FIELD,
	],
	'eadmin_list_fields' => [
		'state' 	 => \Eadmin\Expand\View\StateField::class,
		'is_show'    => \Eadmin\Expand\View\RadioListField::class,
		'type'       => \Eadmin\Expand\View\RadioListField::class,
		'created_on' => \Eadmin\Expand\View\DateField::class,
		'modify_on'  => \Eadmin\Expand\View\DateField::class,
	],
];