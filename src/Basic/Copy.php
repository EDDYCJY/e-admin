<?php

namespace Eadmin\Basic;

use Yii;

class Copy
{
	const DS = DIRECTORY_SEPARATOR;

	protected $from;

	protected $to;

	public function __construct($from, $to)
	{
		$this->from = $from;
		$this->to = $to;
	}

}