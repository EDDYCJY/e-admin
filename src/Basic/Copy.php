<?php

namespace Eadmin\Basic;

use Yii;

class Copy
{
	const DS = DIRECTORY_SEPARATOR;

	protected $from;

	protected $to;

	protected $locker;

	protected $chmod = 0755;

	public function __construct($from, $to, $locker)
	{
		$this->from = $from;
		$this->to = $to;
		$this->locker = $locker;
	}

}