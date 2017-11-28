<?php

namespace Eadmin\Basic;

use Eadmin\Basic\Lock;

/**
 * Class Copy
 * @package Eadmin\Basic
 */
class Copy
{
	const DS = DIRECTORY_SEPARATOR;

    /**
     * @var string
     */
	protected $from;

    /**
     * @var string
     */
	protected $to;

    /**
     * @var object
     */
	protected $locker;

    /**
     * @var int
     */
	protected $chmod = 0755;

    /**
     * Copy constructor.
     *
     * @param string $from   source from
     * @param string $to     destination to
     * @param \Eadmin\Basic\Lock $locker
     * @return null
     */
	public function __construct($from, $to, Lock $locker)
	{
		$this->from = $from;

		$this->to = $to;
		
		$this->locker = $locker;

        return null;
	}

}