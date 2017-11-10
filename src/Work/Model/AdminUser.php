<?php
namespace Eadmin\Work\model;

use Eadmin\Basic\Model;

class AdminUser extends Model
{
	public $label_name = '管理员';

	public $verbose_name = '后台管理员管理';

	public $comment = '后台管理员表';

    public $list_display = [
        'id',
        'user_name',
        'created_on',
        'created_by',
        'modify_on',
        'modify_by',
        'state',
    ];

    public $detail_display = [
        'id',
        'user_name',
        'state',
    ];

	public $id = [
		'type' => 'PrimaryField',
		'comment' => '主键ID',
	];

	public $user_name = [
		'type' => 'TextField',
		'max_length' => 50,
		'default' => '',
		'comment' => '登陆账户',
	];

	public $password = [
		'type' => 'TextField',
		'max_length' => 50,
		'default' => '',
		'comment' => '登陆密码',
	];

	public $created_on = [
		'type' => 'IntegerField',
		'default' => 0,
		'comment' => '创建时间',
	];

	public $created_by = [
		'type' => 'TextField',
		'max_length' => 100,
		'default' => '',
		'comment' => '创建人',
	];

	public $modify_on = [
		'type' => 'IntegerField',
		'default' => 0,
		'comment' => '修改时间',
	];

	public $modify_by = [
		'type' => 'TextField',
		'max_length' => 100,
		'default' => '',
		'comment' => '修改人',
	];

	public $state = [
		'type' => 'TinyintField',
		'default' => 1,
		'comment' => '状态（0为禁用，1为启用）',
	];

}