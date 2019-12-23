<?php

namespace {
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	ini_set('memory_limit', '-1');
	

	use Todo\Domain\Model\Todo\Todo;
	use Todo\Domain\Model\Todo\TodoName;
	use Todo\Domain\Model\Todo\Owner;
	use Todo\Domain\Model\Todo\OwnerService;
	use Todo\Domain\Model\Todo\TodoDeadline;
	use Todo\Domain\Model\Todo\TodoReminder;
	use Todo\Domain\Model\Todo\TodoId;
	use Todo\Infrastructure\Persistence\Doctrine\TodoList;

	require 'vendor/autoload.php';

	require_once "bootstrap.php";

	$entityManager->getConnection()->getConfiguration()->setSQLLogger(null);

	echo "===== DEMO =====\n";

	$owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
	$todoId = TodoId::generate();
	$todo = Todo::add($todoId, TodoName::fromString('Learn TDD'), $owner);
	$deadline = TodoDeadline::fromString('2020-01-20 11:00:00');
	$reminder = TodoReminder::fromString('2020-01-19 11:00:00');
	$todo->addReminder($owner, $reminder);
	$todo->addDeadline($owner, $deadline);
	$todoList = new TodoList($entityManager);
	$todoList->add($todo);

	echo $todo->getStatus() . "\n";

	$todo->markAsDone();
	$todoList->persist($todo);

	echo $todo->getStatus() . "\n";
}