<?php
namespace Eadmin\Kernel\Support;

use Eadmin\Kernel\Parse\Model;
use Eadmin\Kernel\Parse\Table;
use Eadmin\Kernel\Support\Container;

class Gen
{
	private $modeler;
	
	private $tabler;

	public function __construct($object)
	{
		$this->modeler = new Model($object);

		$this->tabler = new Table($this->modeler);
	}

	public function bind()
	{
		Container::bind($this->tabler->getTableFullName(), function() {
			return [
				'metaParams'  => $this->modeler->metaParams,
				'showParams'  => $this->modeler->showParams,
				'modelParams' => $this->modeler->modelParams,
			];
		});
	}

	public function getTabler()
	{
		return $this->tabler;
	}

	public function getModeler()
	{
		return $this->modeler;
	}

}