<?php

namespace Eadmin\Kernel\Gen;

use Eadmin\Kernel\Gii\Generators\Model\Generator;

class Model
{
	public $namespace = 'backend\models';

	public $queryClassSuffix = 'Query';

	public function start($tabler)
	{
		$gii = new Generator();
		$gii->ns = $this->namespace;
		$gii->tableName = $tabler->getTablePrefix() . '_' . $tabler->getTableName();
		$gii->modelClass = $tabler->getTableOriginName();
		$gii->queryNs = $this->namespace;
		$gii->queryClass = $tabler->getTableOriginName() . $this->queryClassSuffix;
		$gii->useTablePrefix = true;
		$gii->generateLabelsFromComments = true;
		
		return $gii;
	}
}