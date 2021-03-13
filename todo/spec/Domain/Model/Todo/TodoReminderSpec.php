<?php

namespace spec\Todo\Domain\Model\Todo;

use PhpSpec\ObjectBehavior;
use Todo\Domain\Model\Todo\TodoReminder;

class TodoReminderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedFromString('2020-12-20 11:00:00');
    }

    function it_knows_when_it_is_in_the_future()
    {
        $this->beConstructedFromString($this->tomorrow());
        $this->isInTheFuture()->shouldReturn(true);
    }

    function it_knows_when_it_is_in_the_past()
    {
        $this->beConstructedFromString('1962-07-05 11:00:00');
        $this->isInThePast()->shouldReturn(true);
    }

    private function tomorrow()
    {
        $tomorrow = (new \DateTimeImmutable('now'))
            ->add(new \DateInterval('P1D'))
            ->format('Y-m-d');

        return $tomorrow;
    }
}
