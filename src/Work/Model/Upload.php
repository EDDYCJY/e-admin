<?php
namespace Eadmin\Work\Model;

use Eadmin\Basic\Model;

class Upload extends Model
{
	public $verbose_name = '上传图片管理';

	public $comment = '上传图片表';

	public $options = [
		'menu' => [
			'is_show' => 0,
		],
	];

	public $id = [
		'type' => 'PrimaryField',
		'comment' => '主键ID',
		'label' => 'ID',
	];

	public $url = [
		'type' => 'VarcharField',
		'max_length' => 200,
		'default' => '',
		'comment' => '图片路径',
	];

	

}