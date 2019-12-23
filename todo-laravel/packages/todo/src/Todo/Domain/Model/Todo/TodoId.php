<?php

namespace Todo\Domain\Model\Todo;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TodoId
{
	private $uuid;

	private function __construct(UuidInterface $uuid)
	{
		$this->uuid = $uuid;
	}

	public static function fromString(string $todoId): TodoId
	{
		return new self(Uuid::fromString($todoId));
	}

	public static function generate(): TodoId
	{
		return new self(Uuid::uuid4());
	}

	public function toString(): string
	{
		return $this->uuid->toString();
	}
	
	public function __toString(): string
	{
		return $this->toString();
	}
	
	public function equals(self $other): bool
	{
		return $this->toString() === $other->toString();
	}
}