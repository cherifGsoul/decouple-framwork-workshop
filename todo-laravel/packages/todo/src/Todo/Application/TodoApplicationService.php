<?php

namespace Todo\Application;

use Todo\Domain\Model\Todo\TodoList;
use Todo\Domain\Model\Todo\Todo;
use Todo\Domain\Model\Todo\TodoName;
use Todo\Domain\Model\Todo\OwnerService;
use Todo\Domain\Model\Todo\TodoDeadline;
use Todo\Domain\Model\Todo\TodoReminder;
use Todo\Domain\Model\Todo\TodoId;

class TodoApplicationService implements TodoApplicationServiceInterface
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
        $todoId = $this->todoList->generateId();
        $todo = Todo::add($todoId, TodoName::fromString($name), $owner);
        $this->todoList->add($todo);
    }

    public function markTodoAsDone(string $todoId, string $ownerId)
    {
        $owner = $this->ownerService->get($ownerId);
        $todo = $this->todoList->getTodoById(TodoId::fromString($todoId));
        $todo->markAsDone($owner);
        $this->todoList->persist($todo);
    }

    public function reopenTodo(string $todoId, string $ownerId)
    {
        $owner = $this->ownerService->get($ownerId);
        $todo = $this->todoList->getTodoById(TodoId::fromString($todoId));
        $todo->reopen($owner);
        $this->todoList->persist($todo);
    }

    public function addDeadLineToTodo(string $todoName, string $deadline, string $ownerId)
    {
        $todo = $this->todoList->getTodoByName(TodoName::fromString($todoName));
        $owner = $this->ownerService->get($ownerId);
        $todo->addDeadline($owner, TodoDeadline::fromString($deadline));
        $this->todoList->persist($todo);
    }

    public function addReminderToTodo(string $todoName, string $reminder, string $ownerId)
    {
        $todo = $this->todoList->getTodoByName(TodoName::fromString($todoName));
        $owner = $this->ownerService->get($ownerId);
        $todo->addReminder($owner, TodoReminder::fromString($reminder));
        $this->todoList->persist($todo);
    }
}
