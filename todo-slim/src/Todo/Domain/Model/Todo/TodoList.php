<?php

namespace Todo\Domain\Model\Todo;

interface TodoList
{

    public function add(Todo $todo);

    public function getTodoByName(TodoName $name) : Todo;

    public function generateId() : TodoId;

    public function persist(Todo $todo);

    public function getTodoById(TodoId $id);
}
