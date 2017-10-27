<?php
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class IntegerField
{
	public function getType()
	{
		return Constants::SCHEMA_INT;
	}

	public function getLength()
	{
		return "11";
	}
}