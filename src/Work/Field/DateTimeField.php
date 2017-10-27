<?php
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class DateTimeField
{
	public function getType()
	{
		return Constants::SCHEMA_DATETIME;
	}

	public function getLength()
	{
		return "";
	}
}