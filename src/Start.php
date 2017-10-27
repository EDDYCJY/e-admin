<?php
namespace Eadmin;

use Eadmin\Gen;
use Eadmin\Work\Model\AdminMenu;
use Eadmin\Work\Model\Article;
use Eadmin\Work\Model\AdminUser;

class Start
{
	public function init()
	{
		Gen::start(new AdminMenu());
        Gen::start(new Article());
        Gen::start(new AdminUser());
	}
}