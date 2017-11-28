<?php

namespace Eadmin\Basic;

/**
 * Class Command
 * @package Eadmin\Basic
 */
class Command
{
    /**
     * @var array
     */
	protected $success = [];

    /**
     * @var array
     */
	protected $error = [];

    /**
     * @var string
     */
	protected $notFound = 'command not found';

    /**
     * Get Success
     *
     * @return array
     */
	public function getSuccess()
	{
		return $this->success;
	}

    /**
     * Get Error
     *
     * @return array
     */
	public function getError()
	{
		return $this->error;
	}

    /**
     * Get NotFound
     *
     * @return string
     */
	public function getNotFound()
	{
		return $this->notFound;
	}

    /**
     * Set Success
     *
     * @param  string $success
     * @return $this
     */
	public function setSuccess($success)
	{
		$this->success[] = $success;

		return $this;
	}

    /**
     * Set Error
     *
     * @param  string $error
     * @return $this
     */
	public function setError($error)
	{
		$this->error[] = $error;

		return $this;
	}

    /**
     * Get Success Message
     *
     * @return string
     */
	public function getSuccessMsg()
	{
		return '[Success]: ' . "\n\n" . implode("\n", $this->getSuccess()) . "\n\n";
	}

    /**
     * Get Error Message
     *
     * @return string
     */
	public function getErrorMsg()
	{
		return '[Error]: ' . "\n\n" . implode("\n", $this->getError()) . "\n\n";
	}

    /**
     * Get NotFound Message
     *
     * @return string
     */
	public function getNotFoundMsg()
	{
		return '[Not Found]: ' . "\n\n" . $this->getNotFound() . "\n\n";
	}

    /**
     * close command
     */
	public function close()
	{
		die;
	}

}