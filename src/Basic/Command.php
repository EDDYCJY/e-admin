<?php

namespace Eadmin\Basic;

class Command
{
	protected $success = [];

	protected $error = [];

	protected $notFound = 'command not found';

	public function getSuccess()
	{
		return $this->success;
	}

	public function getError()
	{
		return $this->error;
	}

	public function getNotFound()
	{
		return $this->notFound;
	}

	public function setSuccess($success)
	{
		$this->success[] = $success;

		return $this;
	}

	public function setError($error)
	{
		$this->error[] = $error;

		return $this;
	}

	public function getSuccessMsg()
	{
		return '[Success]: ' . "\n\n" . implode("\n", $this->getSuccess()) . "\n\n";
	}

	public function getErrorMsg()
	{
		return '[Error]: ' . "\n\n" . implode("\n", $this->getError()) . "\n\n";
	}

	public function getNotFoundMsg()
	{
		return '[Not Found]: ' . "\n\n" . $this->getNotFound() . "\n\n";
	}

	public function close()
	{
		die;
	}

}