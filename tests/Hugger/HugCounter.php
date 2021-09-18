<?php

namespace HuggerTest;

use PHPUnit\Framework\Assert;
use Psr\Hug\Huggable;

class HugCounter implements Huggable
{
    public int $count = 0;

    public function __construct(private int $limit)
    {
    }

    public function hug(Huggable $h):void
    {
        Assert::lessThan($this->limit)
            ->evaluate($this->count++, 'Too many hugs');

        $h->hug($this);
    }
}
