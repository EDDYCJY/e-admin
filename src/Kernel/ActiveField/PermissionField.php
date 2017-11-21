<?php

namespace Eadmin\Kernel\ActiveField;

use Eadmin\Basic\ActiveField;
use Eadmin\Expand\Form\PermissionListbox;

class PermissionField extends ActiveField
{
	private $options;

	private $clientOptions;

	private $items;

	public function init()
	{
		$this->setItems();
		$this->setOptions();
		$this->setClientOptions();
	}

	public function setItems()
	{
		$this->items = 'Eadmin\Entity\AdminMenuEntity::getAllPermission()';

		return true;
	}

	public function setOptions()
	{
		$this->options = [
			'multiple' => true,
		];

		return true;
	}

	public function setClientOptions()
	{
		$this->clientOptions = [
			'moveOnSelect' => true,
            'selectedListLabel' => 'Selected Items',
            'nonSelectedListLabel' => 'Available Items',
		];

		return true;
	}

	public function getItems()
	{
		return $this->items;
	}

	public function getOptions()
	{
		return $this->options;
	}

	public function getClientOptions()
	{
		return $this->clientOptions;
	}

	public function start()
	{
		$object = new PermissionListbox();
		$object->setItems($this->getItems());
		$object->setOptions($this->getOptions());
		$object->setClientOptions($this->getClientOptions());

        return $object->run($this->attribute);
	}
}