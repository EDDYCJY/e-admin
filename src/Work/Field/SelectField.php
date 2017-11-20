<?php
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class SelectField
{
	public function getType()
	{
		return Constants::SCHEMA_TINYINT;
	}

	public function getLength()
	{
		return "4";
	}
}