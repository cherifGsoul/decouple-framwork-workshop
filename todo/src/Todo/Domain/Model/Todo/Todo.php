<?php

namespace Todo\Domain\Model\Todo;

class Todo
{
    private $name;
    private $owner;
    private $status;
    private $deadline;
    private $reminder;

    private function __construct()
    {
    }

    public static function add(TodoName $name, Owner $owner) : self
    {
        $todo = new Todo();

        $todo->name = $name;
        $todo->owner = $owner;
        $todo->status = TodoStatus::OPEN();

        return $todo;
    }

    public function markAsDone()
    {
        if ($this->status->is(TodoStatus::DONE())) {
            throw new \DomainException('Todo is already done');
        }
        $this->status = TodoStatus::DONE();
    }

    public function reopen()
    {
        if ($this->status->is(TodoStatus::OPEN())) {
            throw new \DomainException('Todo is already open');
        }
        $this->status = TodoStatus::OPEN();
    }
    
    public function addReminder(Owner $owner, TodoReminder $reminder)
    {
        if (!$owner->equals($this->owner)) {
            throw new \DomainException('Only the owner of the todo can add deadline!');
        }

        if ($this->status->is(TodoStatus::DONE())) {
            throw new \DomainException('Deadline can only be added to an open todo!');
        }

        if ($reminder->isInThePast()) {
            throw new \DomainException('Reminder must not be in the past!');
        }

        $this->reminder = $reminder;
    }

    public function addDeadline(Owner $owner, TodoDeadline $deadline)
    {
        if (!$owner->equals($this->owner)) {
            throw new \DomainException('Only the owner of the todo can add deadline!');
        }

        if ($this->status->is(TodoStatus::DONE())) {
            throw new \DomainException('Deadline can only be added to an open todo!');
        }

        if ($deadline->isInThePast()) {
            throw new \DomainException('Dedaline must not be in the past!');
        }

        $this->deadline = $deadline;
    }

    public function getName() : TodoName
    {
        return $this->name;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getReminder() : TodoReminder
    {
        return $this->reminder;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }
}
