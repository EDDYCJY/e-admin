<?php
namespace Eadmin\Work\Model;

use Eadmin\Basic\Model;

class AdminRole extends Model
{
	public $verbose_name = '角色管理';

	public $comment = '后台角色权限表';

	public $list_display = [
		'id',
		'role_name',
		'description',
		'is_show',
		'state',
	];

	public $id = [
		'type' => 'PrimaryField',
		'comment' => '主键ID',
		'label' => 'ID',
	];

	public $role_name = [
		'type' => 'VarcharField',
		'max_length' => 50,
		'default' => '',
		'comment' => '角色名称',
	];

	public $description = [
		'type' => 'VarcharField',
		'max_length' => 255,
		'default' => '',
		'comment' => '角色描述',
	];

	public $permissions = [
		'type' => 'PermissionField',
		'max_length' => 255,
		'default' => '',
		'comment' => '多个权限节点',
	];

	public $is_show = [
		'type' => 'RadioListField',
		'comment' => '是否展示',
		'default' => 1,
		'options' => [
			'choices' => [
				0 => '否',
				1 => '是',
			],
		]
	];

	public $state = [
		'type' => 'StateField',
		'label' => '状态',
		'comment' => '状态（0为禁用，1为启用）',
		'default' => 0,
		'options' => [
			'choices' => [
				0 => '禁用',
				1 => '启用',
			],
		]
	];

}