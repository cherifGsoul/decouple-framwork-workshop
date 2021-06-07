<?php

namespace spec\Todo\Application;

use PhpSpec\ObjectBehavior;
use Todo\Application\TodoService;
use Todo\Domain\Model\Todo\TodoList;
use Todo\Domain\Model\Todo\Todo;
use Todo\Domain\Model\Todo\TodoName;
use Todo\Domain\Model\Todo\Owner;
use Todo\Domain\Model\Todo\OwnerService;
use Todo\Domain\Model\Todo\TodoDeadline;
use Todo\Domain\Model\Todo\TodoReminder;
use Todo\Domain\Model\Todo\TodoId;

class TodoApplicationServiceSpec extends ObjectBehavior
{
    function it_adds_todo(TodoList $todoList, OwnerService $ownerService)
    {
        $owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
        $todoId = TodoId::generate();
        $todo = Todo::add($todoId, TodoName::fromString('Learn TDD'), $owner);
        $todoList->generateId()->willReturn($todoId);
        $todoList->add($todo)->shouldBeCalled();
        $ownerService->get('an-id')->willReturn($owner);
        $this->beConstructedWith($todoList, $ownerService);
        $this->addTodo('Learn TDD', 'an-id');
    }

    function it_marks_todo_as_done(TodoList $todoList, OwnerService $ownerService)
    {
        $todoId = TodoId::generate();
        $todo = Todo::add($todoId, TodoName::fromString('Learn TDD'), Owner::from('an-id', 'cherif@site.com', 'cherif_b'));
        $todoList->getTodoByName($todo->getName())->willReturn($todo);
        $todoList->persist($todo)->shouldBeCalled();
        $this->beConstructedWith($todoList, $ownerService);
        $this->markTodoAsDone('Learn TDD');
        $todoList->getTodoByName($todo->getName())->shouldHaveBeenCalled();
    }

    function it_reopens_a_done_todo(TodoList $todoList, OwnerService $ownerService)
    {
        $todoId = TodoId::generate();
        $todo = Todo::add($todoId, TodoName::fromString('Learn TDD'), Owner::from('an-id', 'cherif@site.com', 'cherif_b'));
        $todo->markAsDone();
        $todoList->getTodoByName($todo->getName())->willReturn($todo);
        $todoList->persist($todo)->shouldBeCalled();
        $this->beConstructedWith($todoList, $ownerService);
        $this->reopenTodo('Learn TDD');
        $todoList->getTodoByName($todo->getName())->shouldHaveBeenCalled();
    }

    function it_adds_deadline_to_todo(TodoList $todoList, OwnerService $ownerService)
    {
        $deadline = TodoDeadline::fromString($this->tomorrow());
        $owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
        $todoId = TodoId::generate();
        $todo = Todo::add($todoId, TodoName::fromString('Learn TDD'), $owner);
        $todoList->getTodoByName($todo->getName())->shouldBeCalled();
        $todoList->getTodoByName($todo->getName())->willReturn($todo);
        $ownerService->get('an-id')->shouldBeCalled();
        $ownerService->get('an-id')->willReturn($owner);
        $todoList->persist($todo)->shouldBeCalled();
        $this->beConstructedWith($todoList, $ownerService);
        $this->addDeadLineToTodo('Learn TDD' ,$deadline, 'an-id');
    }

    function it_adds_reminder_to_todo(TodoList $todoList, OwnerService $ownerService)
    {
        $reminder = TodoReminder::fromString($this->tomorrow());
        $owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
        $todoId = TodoId::generate();
        $todo = Todo::add($todoId, TodoName::fromString('Learn TDD'), $owner);
        $todoList->getTodoByName($todo->getName())->shouldBeCalled();
        $todoList->getTodoByName($todo->getName())->willReturn($todo);
        $ownerService->get('an-id')->shouldBeCalled();
        $ownerService->get('an-id')->willReturn($owner);
        $todoList->persist($todo)->shouldBeCalled();
        $this->beConstructedWith($todoList, $ownerService);
        $this->addReminderToTodo('Learn TDD' ,$reminder, 'an-id');
    }

    private function tomorrow()
    {
        $tomorrow = (new \DateTimeImmutable('now'))
            ->add(new \DateInterval('P1D'))
            ->format('Y-m-d');

        return $tomorrow;
    }
}
