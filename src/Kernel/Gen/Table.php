<?php

namespace Eadmin\Kernel\Gen;

use Eadmin\Entity\TableEntity;

/**
 * Class Table
 * @package Eadmin\Kernel\Gen
 */
class Table
{
	/**
	 * 解析创建表-Command
	 */
	public function start($tabler)
	{
		$tableName = $tabler->getTablePrefix() . $tabler->getTableName();
		$columns   = $tabler->getTableField();
		$options   = $tabler->getTabelEngine() . $tabler->getTableCharset() . $tabler->getTableComment();

        return TableEntity::create($tableName, $columns, $options);
	}
}