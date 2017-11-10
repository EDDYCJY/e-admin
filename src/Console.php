<?php
namespace Eadmin;

use Eadmin\Gen;
use Eadmin\Config;
use Eadmin\Work\Model\AdminMenu;
use Eadmin\Work\Model\Article;
use Eadmin\Work\Model\AdminUser;
use Eadmin\Work\Model\Upload;

class Console
{
	public static function init()
	{
		Config::init();

		Gen::init();
		Gen::start(new AdminMenu());
		Gen::start(new Upload());
        Gen::start(new Article());
        Gen::start(new AdminUser());
        Gen::extra();
	}
}