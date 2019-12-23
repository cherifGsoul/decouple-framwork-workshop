<?php

namespace Todo\Infrastructure\Framework\Laravel\Http\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Todo\Application\TodoApplicationServiceInterface;

class Todo extends Controller
{
    private $todoService;

    public function __construct(TodoApplicationServiceInterface $todoService)
    {
        $this->todoService = $todoService;
    }

    public function add()
    {
        $this->todoService->addTodo('Learn TDD', 'qwerty');
    }

    public function markAsDone(Request $request)
    {
        $this->todoService->markTodoAsDone($request->input('id'), 'qwerty');
    }

    public function reopen(Request $request)
    {
        $this->todoService->reopenTodo($request->input('id'), 'qwerty');
    }
}
