<?php

namespace Eadmin\Kernel\Gen;

class Setting
{
	public $site_title = 'Test Global';

	public $mini_site_title = 'Test';

	public $site_footer = 'Test Footer';

	public function get()
	{
		return get_class_vars(get_class($this));
	}

}