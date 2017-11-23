<?php

namespace Eadmin\Entity;

use Yii;

class TableEntity
{
	public static function create($tableName, $columns, $options)
	{
		return Yii::$app->db->createCommand()->createTable($tableName, $columns, $options);
	}

	public static function drop($tableName)
	{
		return Yii::$app->db->createCommand()->dropTable($tableName);
	}

}