<?php

namespace Todo\Infrastructure\Web\PSR15\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Todo\Application\Handler\AddTodoCommandHandler;
use Todo\Application\TodoApplicationServiceInterface;
use Zend\Diactoros\Response\JsonResponse;

class MarkTodoAsDoneHandler implements RequestHandlerInterface
{
    private $service;

    public function __construct(TodoApplicationServiceInterface $service)
    {
        $this->service = $service;
    }

	public function handle(ServerRequestInterface $request) : ResponseInterface
	{
        $data = $request->getParsedBody();
        $out = $this->service->markTodoAsDone($data['id'], 'qwerty');

        return (new JsonResponse($out))
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
	}
}