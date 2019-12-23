<?php

namespace Todo\Domain\Model\Todo;

use MyCLabs\Enum\Enum;

class TodoStatus extends Enum
{
	private const OPEN = 'open';
	private const DONE = 'done';
}