<?php

namespace Todo\Infrastructure\Persistence\Capsule;

use Todo\Domain\Model\Todo\Todo;
use Todo\Domain\Model\Todo\TodoId;
use Todo\Domain\Model\Todo\TodoName;
use Todo\Domain\Model\Todo\TodoList;
use Todo\Infrastructure\Framework\Laravel\Model\Todo as TodoRecord;

class EloquentTodoList implements TodoList
{
    public function add(Todo $todo)
    {
        $todoRecord = new TodoRecord();
        $this->save($todo, $todoRecord);
    }

    public function getTodoByName(TodoName $name) : Todo
    {
        $todoRecord = TodoRecord::where('name', (string)$name)->first();
        if (is_null($todoRecord)) {
            throw new \Exception('Todo not found');
        }

        return Todo::fromState($todoRecord->toArray());
    }

    public function getTodoById(TodoId $id) : Todo
    {
        $todoRecord = TodoRecord::where('id', $id)->first();
        if (is_null($todoRecord)) {
            throw new \Exception('Todo not found');
        }
        return Todo::fromState($todoRecord->toArray());
    }

    public function generateId() : TodoId
    {
        return TodoId::generate();
    }

    public function persist(Todo $todo)
    {
        $todoRecord = TodoRecord::where('id', (string)$todo->getId())->first();
        $this->save($todo, $todoRecord);
    }

    private function save(Todo $todo, TodoRecord $todoRecord)
    {
        $todoRecord->name = (string)$todo->getName();
        $todoRecord->id = (string)$todo->getId();
        $todoRecord->status = (string)$todo->getStatus();
        $todoRecord->owner_id = (string)$todo->getOwner()->getId();
        $todoRecord->owner_username = (string)$todo->getOwner()->userName();
        $todoRecord->owner_email = (string)$todo->getOwner()->emailAddress();
        $todoRecord->deadline = (string)$todo->getDeadline() ? $todo->getDeadline() : null;
        $todoRecord->reminder = (string)$todo->getReminder() ? $todo->getReminder() : null;
        $todoRecord->save();
    }
}
