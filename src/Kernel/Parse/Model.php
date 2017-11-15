<?php

namespace Eadmin\Kernel\Parse;

class Model
{
	public $classer = [];

	public $metaParams = [];

	public $showParams = [];

	public $modelParams = [];

	public $namespace = [
		'field' => 'Eadmin\Work\Field',
	];

	public function __construct($object)
	{
		$className   = get_class($object);
		$classParams = get_class_vars($className);

		$this->classer  = [
			'name'   => $className,
			'params' => $classParams
		];

		foreach ($this->classer['params'] as $key => $value) {
			if(in_array($key, $object->getMetas())){
				$this->metaParams[$key] = $value;
			} else if(in_array($key, $object->getShows())){
				$this->showParams[$key] = $value;
			} else {
				$this->modelParams[$key] = $value;
			}
		}
	}


}