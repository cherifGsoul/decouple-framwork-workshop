<?php

namespace Todo\Domain\Model\Todo;

interface TodoList
{

    public function save(Todo $todo);

    public function getTodoByName($argument1);
}
