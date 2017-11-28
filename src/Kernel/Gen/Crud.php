<?php

namespace Eadmin\Kernel\Gen;

use Eadmin\Config;
use Eadmin\Kernel\Gii\Generators\Crud\Generator;

/**
 * Class Crud
 * @package Eadmin\Kernel\Gen
 */
class Crud
{
	public $namespace = [
		'model' => 'backend\models',
		'controller' => 'backend\controllers',
		'view' => '@backend/views',
	];

	public $searchClassSuffix = 'Search';

	public $controllerClassSuffix = 'Controller';

	public function __construct()
	{
		$configs = Config::get('App', 'eadmin_generator_configs')['crud'];
		if(! empty($configs['namespace'])) {
			$this->namespace = $configs['namespace'];
		}
		if(! empty($configs['searchClassSuffix'])) {
			$this->searchClassSuffix = $configs['searchClassSuffix'];
		}
		if(! empty($configs['controllerClassSuffix'])) {
			$this->controllerClassSuffix = $configs['controllerClassSuffix'];
		}
	}

	public function start($tabler)
	{
		$gii = new Generator();
		$gii->modelClass = $this->namespace['model'] . '\\' . $tabler->getTableOriginName();
		$gii->searchModelClass = $this->namespace['model'] . '\\' . $tabler->getTableOriginName() . $this->searchClassSuffix;
		$gii->controllerClass = $this->namespace['controller'] . '\\' . $tabler->getTableOriginName() . $this->controllerClassSuffix;
		$gii->viewPath = $this->namespace['view'] . '/' . $tabler->getTableViewName();

		return $gii;
	}
}