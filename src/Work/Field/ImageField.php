<?php
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class ImageField
{
	public function getType()
	{
		return Constants::SCHEMA_VARCHAR;
	}

	public function getLength()
	{
		return "255";
	}
}