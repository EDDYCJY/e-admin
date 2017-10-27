<?php

namespace Eadmin\Kernel\Gen;

use Yii;

class Table
{
	/**
	 * 解析创建表-Command
	 * 
	 * @return object 
	 */
	public function start($tabler)
	{
		$table   = $tabler->getTablePrefix() . '_' . $tabler->getTableName();
		$columns = $tabler->getTableField();
		$options = $tabler->getTabelEngine() . $tabler->getTableCharset() . $tabler->getTableComment();

		$createCommand = Yii::$app->db->createCommand()->createTable($table, $columns, $options);

		return $createCommand;
	}
}