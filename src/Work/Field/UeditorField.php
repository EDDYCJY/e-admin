<?php
namespace Eadmin\Work\Field;

use Eadmin\Constants;

class UeditorField
{
	public function getType()
	{
		return Constants::SCHEMA_TEXT;
	}

	public function getLength()
	{
		return "";
	}
}