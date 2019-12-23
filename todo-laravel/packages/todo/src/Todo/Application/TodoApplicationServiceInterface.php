<?php

namespace Todo\Application;

interface TodoApplicationServiceInterface
{
	public function addTodo(string $name, string $ownerId);

	public function markTodoAsDone(string $todoId, string $ownerId);

	public function reopenTodo(string $todoId, string $ownerId);

	public function addDeadLineToTodo(string $todoName, string $deadline, string $ownerId);

	public function addReminderToTodo(string $todoName, string $reminder, string $ownerId);
}
