<?php

namespace Eadmin\Expand\Export;

class TimeField
{
	public function start()
	{
		return "date('Y-m-d H:i', %s)";
	}
}