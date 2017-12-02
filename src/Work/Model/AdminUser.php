<?php
namespace Eadmin\Work\model;

use Eadmin\Basic\Model;

class AdminUser extends Model
{
	public $label = '管理员';

	public $verbose_name = '后台管理员管理';

	public $comment = '后台管理员表';

	public $options = [
		'export' => [
			'fileName' => '后台管理员',
			'fileFormat' => 'Excel5', 
			'field' => [
				'role_id',
				'user_name',
				'created_on',
				'created_by',
				'modify_on',
				'modify_by',
				'state',
			],
		],
	];

	public $id = [
		'type' => 'PrimaryField',
		'comment' => '主键ID',
		'label' => 'ID',
	];

	public $role_id = [
		'type' => 'TinyintField',
		'default' => 0,
		'comment' => '权限ID',
		'relations' => [
			'class' => 'AdminRole',
			'link' => 'id',
			'label' => '权限名称',
			'attribute' => 'role_name',
		],
	];

	public $user_name = [
		'type' => 'VarcharField',
		'max_length' => 50,
		'default' => '',
		'comment' => '登陆账户',
	];

	public $password = [
		'type' => 'VarcharField',
		'max_length' => 50,
		'default' => '',
		'comment' => '登陆密码',
	];

	public $created_on = [
		'type' => 'TimeField',
		'default' => 0,
		'comment' => '创建时间',
	];

	public $created_by = [
		'type' => 'VarcharField',
		'max_length' => 100,
		'default' => '',
		'comment' => '创建人',
	];

	public $modify_on = [
		'type' => 'TimeField',
		'default' => 0,
		'comment' => '修改时间',
	];

	public $modify_by = [
		'type' => 'VarcharField',
		'max_length' => 100,
		'default' => '',
		'comment' => '修改人',
	];

	public $state = [
		'type' => 'StateField',
		'default' => 1,
		'label' => '状态',
		'comment' => '状态（0为禁用，1为启用）',
		'options' => [
			'choices' => [
				0 => '禁用',
				1 => '启用',
			],
		]
	];

}