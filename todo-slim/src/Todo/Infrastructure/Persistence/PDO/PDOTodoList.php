<?php


namespace Todo\Infrastructure\Persistence\PDO;


use http\Exception;
use Todo\Domain\Model\Todo\Todo;
use Todo\Domain\Model\Todo\TodoId;
use Todo\Domain\Model\Todo\TodoList as TodoListRepository;
use Todo\Domain\Model\Todo\TodoName;

class PDOTodoList implements TodoListRepository
{
    private $todoDAO;

    public function __construct(TodoDAO $todoDAO)
    {
        $this->todoDAO = $todoDAO;
    }

    public function add(Todo $todo)
    {
        return $this->todoDAO->create($todo->toState());
    }

    public function getTodoByName(TodoName $name): Todo
    {
        // TODO: Implement getTodoByName() method.
    }

    public function generateId(): TodoId
    {
        return TodoId::generate();
    }

    public function persist(Todo $todo)
    {
        $data = $todo->toState();
        return $this->todoDAO->update($data);
    }

    public function getTodoById(TodoId $id)
    {
        $data = $this->todoDAO->findById((string)$id);

        if (is_null($data)) {
            throw new \Exception('Todo is not found');
        }

        return Todo::fromState($data);
    }
}