<?php

namespace Todo\Domain\Model\Todo;

interface OwnerService
{

    public function get(string $id) : Owner;
}
