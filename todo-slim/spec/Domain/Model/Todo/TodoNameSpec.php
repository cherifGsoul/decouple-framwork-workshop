<?php

namespace spec\Todo\Domain\Model\Todo;

use PhpSpec\ObjectBehavior;
use Todo\Domain\Model\Todo\TodoName;

class TodoNameSpec extends ObjectBehavior
{
    function it_instantiated_from_string()
    {
        $this->beConstructedFromString('Make a Workshop');
        $this->getValue()->shouldReturn('Make a Workshop');
    }

    function it_can_not_be_empty_string()
    {
        $this->beConstructedFromString('');
        $this->shouldThrow('\InvalidArgumentException')->duringInstantiation();
    }
}
