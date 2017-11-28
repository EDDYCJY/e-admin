<?php

namespace Eadmin\Kernel\Gen;

use Eadmin\Config;
use Eadmin\Kernel\Gii\Generators\Model\Generator;

/**
 * Class Model
 * @package Eadmin\Kernel\Gen
 */
class Model
{
	public $namespace = 'backend\models';

	public $queryClassSuffix = 'Query';

	public function __construct()
	{
		$configs = Config::get('App', 'eadmin_generator_configs')['model'];
		if(! empty($configs['namespace'])) {
			$this->namespace = $configs['namespace'];
		}
		if(! empty($configs['queryClassSuffix'])) {
			$this->queryClassSuffix = $configs['queryClassSuffix'];
		}
	}

	public function start($tabler)
	{
		$gii = new Generator();
		$gii->ns = $this->namespace;
		$gii->tableName = $tabler->getTablePrefix() . $tabler->getTableName();
		$gii->modelClass = $tabler->getTableOriginName();
		$gii->queryNs = $this->namespace;
		$gii->queryClass = $tabler->getTableOriginName() . $this->queryClassSuffix;
		$gii->useTablePrefix = true;
		$gii->generateLabelsFromComments = true;
		
		return $gii;
	}
}