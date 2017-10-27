<?php
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class TimeField
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