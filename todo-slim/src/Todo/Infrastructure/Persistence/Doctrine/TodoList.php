<?php

namespace Todo\Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Todo\Domain\Model\Todo\Todo;
use Todo\Domain\Model\Todo\TodoId;
use Todo\Domain\Model\Todo\TodoName;

class TodoList implements \Todo\Domain\Model\Todo\TodoList
{
	private $entityManager;
	private $repository;

	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
		$this->repository = $entityManager->getRepository(Todo::class);
	}
	
	public function add(Todo $todo)
	{
		$this->entityManager->persist($todo);
		$this->entityManager->flush();
	}

	public function getTodoByName(TodoName $name) : Todo
	{
		$todo = $this->repository->findOneBy(['name' => $name]);
		if (is_null($todo)) {
			throw new \Exception('Todo not found');
		}

		return $todo;
	}

	public function generateId() : TodoId
	{
		return TodoId::generate();
	}

	public function persist(Todo $todo)
	{
		$this->entityManager->persist($todo);
		$this->entityManager->flush();
	}
}
