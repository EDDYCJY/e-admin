<?php

namespace Eadmin\Expand;

use Eadmin\Config;

class Start
{
	public static function view($attribute, $container)
	{
		$configs = Config::get('App', 'eadmin_list_fields');
		if(array_key_exists($attribute, $configs)) {
			$namespace = $configs[$attribute];

			return trim('[' . $namespace::column($attribute, $container) . ']', "'");
		}

		return "'" . $attribute . "'";
	}
}