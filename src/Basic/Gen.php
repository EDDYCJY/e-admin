<?php

namespace Eadmin\Basic;

use Eadmin\Kernel\Support\Table;
use Eadmin\Kernel\Support\Container;

class Gen
{
	//解析对象
	public $objecter;

	//Table对象
	public $tabler;

	//生成命名空间
	public $namespace = [
		'model' => 'backend\models',
		'controller' => 'backend\controllers',
		'view' => '@backend/views',
		'field' => 'Eadmin\Work\Field',
	];

	//解析类信息
	public $classer = [];

	//描述信息
	public $metaParams = [];

	//展示信息
	public $showParams = [];

	//模型信息
	public $modelParams = [];

	public function __construct($object)
	{
		$className   = get_class($object);
		$classParams = get_class_vars($className);
		$this->objecter = $object;	
		$this->classer  = [
			'name'   => $className,
			'params' => $classParams
		];

		$this->load();

		$this->tabler = new Table($this);

		Container::bind($this->tabler->getTableFullName(), function() {
			return [
				'metaParams'  => $this->metaParams,
				'showParams'  => $this->showParams,
				'modelParams' => $this->modelParams,
			];
		});
	}

	/**
	 * 填充数据体
	 */
	private function load()
	{
		foreach ($this->classer['params'] as $key => $value) {
			if(in_array($key, $this->objecter->getMetas())){
				$this->metaParams[$key] = $value;
			} else if(in_array($key, $this->objecter->getShows())){
				$this->showParams[$key] = $value;
			} else {
				$this->modelParams[$key] = $value;
			}
		}

		return true;
	}

}