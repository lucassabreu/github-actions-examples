<?php

namespace Hugger;

use Psr\Hug\Huggable;

class Common implements Huggable
{
    private ?Huggable $who = null;

    /**
     * {@inheritDoc}
     */
    public function hug(Huggable $h)
    {
        if ($this->who == $h) {
            $this->who = null;
            return;
        }

        $this->who = $h;
        $h->hug($this);
    }
}
