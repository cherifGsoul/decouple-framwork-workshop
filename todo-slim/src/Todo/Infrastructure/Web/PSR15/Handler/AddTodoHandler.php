<?php

declare(strict_types=1);

namespace Todo\Infrastructure\Web\PSR15\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Todo\Application\TodoApplicationServiceInterface;
// use Todo\Application\Command\AddTodoCommand;
use Zend\Diactoros\Response\JsonResponse;

class AddTodoHandler implements RequestHandlerInterface
{
	private $service;

	public function __construct(TodoApplicationServiceInterface $service)
	{
		$this->service = $service;
	}

	public function handle(ServerRequestInterface $request) : ResponseInterface
	{
		$data = $request->getParsedBody();
		$out = $this->service->addTodo($data['name'], 'qwerty');
		
		return (new JsonResponse($out))
				->withHeader('Content-Type', 'application/json')
				->withStatus(201);
	}
}