<?php

namespace spec\Todo\Domain\Model\Todo;

use PhpSpec\ObjectBehavior;
use Todo\Domain\Model\Todo\Todo;
use Todo\Domain\Model\Todo\TodoName;
use Todo\Domain\Model\Todo\TodoStatus;
use Todo\Domain\Model\Todo\TodoDeadline;
use Todo\Domain\Model\Todo\TodoReminder;
use Todo\Domain\Model\Todo\Owner;

class TodoSpec extends ObjectBehavior
{
    function let() 
    {
        $owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
        $name = TodoName::fromString('Learn TDD', $owner);
        $this->beConstructedAdd($name, $owner);
    }

    function it_is_instantiated_with_add()
    {
        $owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
        $name = TodoName::fromString('Learn TDD', $owner);
        $this->beConstructedAdd($name, $owner);
        $this->getName()->equals($name)->shouldReturn(true);
        $this->getOwner()->equals($owner)->shouldReturn(true);
    }

    function it_is_open_by_default()
    {
        $this->getStatus()->is(TodoStatus::OPEN())->shouldReturn(true);
    }

    function it_can_be_marked_as_done()
    {
        $this->markAsDone();
        $this->getStatus()->is(TodoStatus::DONE())->shouldReturn(true);
    }

    function it_can_not_be_marked_done_as_if_already_is()
    {
        $this->markAsDone();
        $this->shouldThrow('\DomainException')->during('markAsDone');
    }

    function it_can_get_reopened()
    {
        $this->markAsDone();
        $this->reopen();
        $this->getStatus()->is(TodoStatus::OPEN())->shouldReturn(true);
    }

    function it_can_not_get_reopened_if_already_open()
    {
        $this->shouldThrow('\DomainException')->during('reopen');
    }

    function it_adds_deadline()
    {
        $owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
        $deadline = TodoDeadline::fromString('2020-01-05 11:00:00');
        $this->addDeadline($owner, $deadline);
        $this->getDeadline()->shouldReturn($deadline);
    }

    function it_adds_a_reminder()
    {
        $owner = Owner::from('an-id', 'cherif@site.com', 'cherif_b');
        $reminder = TodoReminder::fromString('2019-12-20 11:00:00');
        $this->addReminder($owner, $reminder);
        $this->getReminder()->shouldReturn($reminder);
    }
}
