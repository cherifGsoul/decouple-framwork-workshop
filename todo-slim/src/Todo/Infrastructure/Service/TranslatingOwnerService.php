<?php

namespace Todo\Infrastructure\Service;

use Todo\Domain\Model\Todo\OwnerService;
use Todo\Domain\Model\Todo\Owner;

class TranslatingOwnerService implements OwnerService
{
    public function get(string $id) : Owner
    {
        return Owner::from('qwerty', 'cherif_b', 'cherif@site.com');
    }
}
