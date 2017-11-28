<?php

namespace Eadmin\Entity;

use Yii;

/**
 * Class TableEntity
 * @package Eadmin\Entity
 */
class TableEntity
{
    /**
     * Create Table Command
     *
     * @param  string $tableName  table_name
     * @param  array  $columns    table_columns
     * @param  array  $options    table options
     * @return object
     */
	public static function create($tableName, $columns, $options)
	{
		return Yii::$app->db->createCommand()->createTable($tableName, $columns, $options);
	}

    /**
     * Drop Table Command
     *
     * @param string $tableName table_name
     * @return object
     */
	public static function drop($tableName)
	{
		return Yii::$app->db->createCommand()->dropTable($tableName);
	}

}