<?php
namespace Eadmin\Work\Model;

use Eadmin\Basic\Model;

class AdminRole extends Model
{
	public $verbose_name = '角色管理';

	public $comment = '后台角色权限表';

	public $id = [
		'type' => 'PrimaryField',
		'comment' => '主键ID',
	];

	public $name = [
		'type' => 'TextField',
		'max_length' => 50,
		'default' => '',
		'comment' => '角色名称',
	];

	public $description = [
		'type' => 'TextField',
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
		'type' => 'StateField',
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
		'label_name' => '状态',
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