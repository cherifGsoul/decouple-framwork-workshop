<?php

namespace Todo\Domain\Model\Todo;

use MabeEnum\Enum;

class TodoStatus extends Enum
{
	const OPEN = 'open';
	const DONE = 'done';
}