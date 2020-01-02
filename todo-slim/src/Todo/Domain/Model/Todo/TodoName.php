<?php

namespace Todo\Domain\Model\Todo;

class TodoName
{
    private $value;

    private function __construct(string $value)
    {
        $this->setValue($value);
    }

    public static function fromString(string $value) : self
    {
        $todoName = new TodoName($value);

        return $todoName;
    }

    public function getValue() : string
    {
        return $this->value;
    }

    private function setValue(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('Todo name must not be empty');
        }
        $this->value = $value;
    }

    public function equals(TodoName $other)
    {
        return $this->value === $other->value;
    }

    public function __toString()
    {
        return $this->value;
    }
}
