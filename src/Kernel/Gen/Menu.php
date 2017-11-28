<?php

namespace Eadmin\Kernel\Gen;

class Menu
{
	public function start($tabler)
	{
		return [
			'parent_id' => $tabler->getTableParentId(),
			'is_show' => $tabler->getTableIsShow(),
			'menu_name' => $tabler->getTableVerboseName(),
			'url' =>  $tabler->getTableViewName() . '/' . 'index',
		];
	}
}