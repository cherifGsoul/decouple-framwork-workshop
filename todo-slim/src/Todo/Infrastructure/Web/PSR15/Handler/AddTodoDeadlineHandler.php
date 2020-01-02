<?php

namespace Todo\Infrastructure\Web\PSR15\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Todo\Application\Handler\AddTodoCommandHandler;

class AddTodoDeadlineHandler implements RequestHandlerInterface
{
	private $handler;

	public function __construct(AddTodoCommandHandler $handler)
	{
		$this->handler = $handler;
	}

	public function handler(ServerRequestInterface $request) : ResponseInterface
	{
		
	}
}