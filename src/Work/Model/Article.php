<?php
namespace Eadmin\Work\Model;

use Eadmin\Basic\Model;

class Article extends Model
{
	public $verbose_name = '后台文章管理';

	public $comment = '文章管理';

	public $id = [
		'type' => 'PrimaryField',
		'comment' => '主键ID',
	];

	public $send_name = [
		'type' => 'TextField',
		'comment' => '名称',
		'max_length'   => 10,
		'null'	       => true,
		'choices'	   => [
			'test1'   => '1',
			'test2'   => '2',
			'test3'   => '3',
			'default' => '',
		],
		'htmlOptions' => [
			'max_length'   => 20,
			'min_length'   => 10,
			'required'	   => 'required',
		],
	];

	public $send_content = [
		'type' => 'TextareaField',
		'comment' => '内容',
		'default' => '',
		'htmlOptions' => [
			'max_length'   => 400,
			'min_length'   => 10,
			'required'	   => 'required',
		],
	];

}