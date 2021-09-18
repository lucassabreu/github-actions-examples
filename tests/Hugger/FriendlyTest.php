<?php

namespace HuggerTest;

use Hugger\Friendly;
use PHPUnit\Framework\TestCase;

class FriendlyTest extends TestCase
{
    public function testWillHugBack(): void
    {
        $friendly = new Friendly();

        $friendly->hug($counter = new HugCounter(2));
        self::assertEquals(1, $counter->count);

        $friendly->hug($counter);
        self::assertEquals(2, $counter->count);
    }

    public function getHugBackLimit()
    {
        for ($i = 1; $i < 10; $i++) {
            yield [$i];
        }
    }

    /**
     * @dataProvider getHugBackLimit
     */
    public function testWillHugExactlyNTimes(int $times): void
    {
        $friendly = new Friendly($times);
        $friendly->hug($counter = new HugCounter($times + 1));
        self::assertEquals($times, $counter->count);

        $friendly->hug($counter = new HugCounter($times + 1));
        self::assertEquals($times, $counter->count);
    }

    /**
     * @dataProvider getHugBackLimit
     */
    public function testWillHugEveryoneEqualy(int $times): void
    {
        $group = [
            new HugCounter($times + 1),
            new HugCounter($times + 1),
        ];

        $friendly = new Friendly($times);
        $friendly->groupHug($group);

        array_map(
            fn ($c) => self::assertEquals($times, $c->count),
            $group
        );
    }
}
