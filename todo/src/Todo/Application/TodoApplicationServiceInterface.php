<?php

namespace Todo\Application;

interface TodoApplicationServiceInterface
{
	public function addTodo(string $name, string $ownerId);

	public function markTodoAsDone(string $todoName);

	public function reopenTodo(string $todoName);

	public function addDeadLineToTodo(string $todoName, string $deadline, string $ownerId);

	public function addReminderToTodo(string $todoName, string $reminder, string $ownerId);
}