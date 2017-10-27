<?php 
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class CharField
{
	public function getType()
	{
		return Constants::SCHEMA_CHAR;
	}

	public function getLength()
	{
		return "20";
	}
}