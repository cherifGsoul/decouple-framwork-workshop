<?php

namespace Todo\Domain\Model\Todo;

class Owner
{
	private $id;
	private $username;
	private $emailAddress;

	public static function from(string $id, string $username, string $emailAddress) : self
	{
		return new Owner($id, $username, $emailAddress);
	}

	public function getId()
	{
		return $this->id;
	}

	public function username()
	{
		return $this->username;
	}

	public function emailAddress()
	{
		return $this->emailAddress;
	}

	private function __construct(string $id, string $username, string $emailAddress)
	{
		$this->id = $id;
		$this->username = $username;
		$this->emailAddress = $emailAddress;
	}

    public function equals(Owner $other)
    {
		return 	$this->id == $other->id &&
				$this->username == $other->username &&
				$this->emailAddress == $other->emailAddress;
    }
}
