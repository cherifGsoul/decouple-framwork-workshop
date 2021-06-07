<?php

namespace Todo\Domain\Model\Todo;

use DateTimeImmutable;

class TodoReminder
{
    private $reminder;

    private function __construct(DateTimeImmutable $reminder)
    {
        $this->reminder = $reminder;
    }

    public static function fromString(string $reminder) : self
    {
        $todoReminder = new TodoReminder(new DateTimeImmutable($reminder));

        return $todoReminder;
    }

    public function isInTheFuture() : bool
    {
        return $this->reminder > new DateTimeImmutable('now');
    }

    public function isInThePast() : bool
    {
        return $this->reminder < new DateTimeImmutable('now');
    }

    public function __toString() : string
    {
        return $this->reminder->format(\DateTime::ATOM);
    }
}
