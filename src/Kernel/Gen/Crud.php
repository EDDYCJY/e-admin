<?php

namespace Eadmin\Kernel\Gen;

use Eadmin\Kernel\Gii\Generators\Crud\Generator;

class Crud
{
	public $namespace = [
		'model' => 'backend\models',
		'controller' => 'backend\controllers',
		'view' => '@backend/views',
	];

	public $searchClassSuffix = 'Search';

	public $controllerClassSuffix = 'Controller';

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