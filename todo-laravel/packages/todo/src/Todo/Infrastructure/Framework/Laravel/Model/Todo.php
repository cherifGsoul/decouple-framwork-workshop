<?php

namespace Todo\Infrastructure\Framework\Laravel\Model;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public $incrementing = false;

    public $timestamps = false;
}
