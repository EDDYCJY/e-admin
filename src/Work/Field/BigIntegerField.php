<?php 
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class BigIntegerField
{
	public function getType()
	{
		return Constants::SCHEMA_BIGINT;
	}

	public function getLength()
	{
		return "20";
	}
}