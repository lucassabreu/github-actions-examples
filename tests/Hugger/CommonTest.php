<?php

namespace HuggerTest;

use Hugger\Common;
use PHPUnit\Framework\TestCase;
use Psr\Hug\Huggable;
use Webmozart\Assert\Assert;

class CommonTest extends TestCase
{
    public function testWillOnlyHugBack():void
    {
        $common = new Common();
        $common->hug($hugger = new HugCounter(2));
        self::assertEquals(1, $hugger->count);

        $common->hug($hugger);
        self::assertEquals(2, $hugger->count);
    }
}
