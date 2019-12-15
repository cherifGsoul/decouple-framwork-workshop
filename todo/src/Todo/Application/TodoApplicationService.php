<?php

namespace Todo\Application;

use Todo\Domain\Model\Todo\TodoList;
use Todo\Domain\Model\Todo\Todo;
use Todo\Domain\Model\Todo\TodoName;
use Todo\Domain\Model\Todo\OwnerService;
use Todo\Domain\Model\Todo\TodoDeadline;
use Todo\Domain\Model\Todo\TodoReminder;

class TodoApplicationService
{
    private $todoList;
    private $ownerService;

    public function __construct(TodoList $todoList, OwnerService $ownerService)
    {
        $this->todoList = $todoList;
        $this->ownerService = $ownerService;
    }

    public function addTodo(string $name, string $ownerId)
    {
        $owner = $this->ownerService->get($ownerId);
        $todo = Todo::add(TodoName::fromString($name), $owner);
        $this->todoList->save($todo);
    }

    public function markTodoAsDone(string $todoName)
    {
        $todo = $this->todoList->getTodoByName(TodoName::fromString($todoName));
        $todo->markAsDone();
        $this->todoList->save($todo);
    }

    public function reopenTodo(string $todoName)
    {
        $todo = $this->todoList->getTodoByName(TodoName::fromString($todoName));
        $todo->reopen();
        $this->todoList->save($todo);
    }

    public function addDeadLineToTodo(string $todoName, string $deadline, string $ownerId)
    {
        $todo = $this->todoList->getTodoByName(TodoName::fromString($todoName));
        $owner = $this->ownerService->get($ownerId);
        $todo->addDeadline($owner, TodoDeadline::fromString($deadline));
        $this->todoList->save($todo);
    }

    public function addReminderToTodo(string $todoName, string $reminder, string $ownerId)
    {
        $todo = $this->todoList->getTodoByName(TodoName::fromString($todoName));
        $owner = $this->ownerService->get($ownerId);
        $todo->addReminder($owner, TodoReminder::fromString($reminder));
        $this->todoList->save($todo);
    }
}
