<?php
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class StateField
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