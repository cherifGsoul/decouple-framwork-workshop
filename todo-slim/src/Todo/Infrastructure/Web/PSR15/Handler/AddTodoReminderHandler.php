<?php

namespace Todo\Infrastructure\Web\PSR15\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Todo\Application\Handler\AddTodoCommandHandler;
use Todo\Application\TodoApplicationServiceInterface;

class AddTodoReminderHandler implements RequestHandlerInterface
{
    private $service;

    public function __construct(TodoApplicationServiceInterface $service)
    {
        $this->service = $service;
    }

	public function handler(ServerRequestInterface $request) : ResponseInterface
	{
		
	}
}