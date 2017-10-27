<?php
namespace Eadmin\Work\Model;

use Eadmin\Basic\Model;

class AdminMenu extends Model
{
	public $verbose_name = '菜单管理';

	public $comment = '后台菜单表';

	public $list_display = [
        'id',
        'parent_id',
        'name',
        'url',
        'icon',
        'is_show',
        'status',
    ];

	public $id = [
		'type' => 'PrimaryField',
		'comment' => '主键ID',
	];

	public $parent_id = [
		'type' => 'IntegerField',
		'default' => 0,
		'unsigned' => true,
		'comment' => '父级ID',
	];

	public $name = [
		'type' => 'TextField',
		'max_length' => 50,
		'default' => '',
		'comment' => '菜单名称',
	];

	public $url = [
		'type' => 'TextField',
		'max_length' => 100,
		'default' => '',
		'comment' => '菜单路径',
	];

	public $icon =[
		'type' => 'TextField',
		'max_length' => 50,
		'default' => '',
		'comment' => 'ICON',
		'htmlOptions' => [
			'maxlength'   => 20,
			'required'	   => 'required',
		],
	];

	public $is_show = [
		'type' => 'TinyintField',
		'unsigned' => true,
		'default' => 1,
		'comment' => '是否在菜单显示',
		// 'htmlOptions' => [
		// 	'choices'	   => [
		// 		'否' => '0',
		// 		'是' => '1',
		// 	],
		// ]
	];

	public $status = [
		'type' => 'TinyintField',
		'unsigned' => true,
		'default' => 1,
		'comment' => '状态',
	];

}