<?php

namespace Hugger;

use Psr\Hug\GroupHuggable;
use Psr\Hug\Huggable;

class Friendly implements GroupHuggable
{
    private ?Huggable $who = null;
    private int $count = 0;

    public function __construct(private int $backHugsLimit = 1)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function hug(Huggable $h): void
    {
        if ($this->who === $h && $this->count >= $this->backHugsLimit) {
            $this->who = null;
            $this->count = 0;
            return;
        }

        $this->who = $h;
        $this->count++;
        $h->hug($this);
    }

    /**
     * {@inheritDoc}
     */
    public function groupHug($huggables): void
    {
        array_map(
            fn ($h) => $this->hug($h),
            $huggables,
        );
    }
}
