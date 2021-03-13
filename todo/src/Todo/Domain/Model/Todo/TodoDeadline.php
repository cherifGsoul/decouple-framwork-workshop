<?php

namespace Todo\Domain\Model\Todo;

use DateTimeImmutable;

class TodoDeadline
{
    private $deadline;

    private function __construct(DateTimeImmutable $deadline)
    {
        $this->deadline = $deadline;
    }

    public static function fromString(string $deadline) : self
    {
        $deadline = new TodoDeadline(new DateTimeImmutable($deadline));

        return $deadline;
    }

    public function isInTheFuture() : bool
    {
        return $this->deadline > new DateTimeImmutable('now');
    }

    public function isInThePast() : bool
    {
        return $this->deadline < new DateTimeImmutable('now');
    }

    public function __toString() : string
    {
        return $this->deadline->format(\DateTime::ATOM);
    }
}
