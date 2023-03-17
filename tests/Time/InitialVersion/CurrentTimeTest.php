<?php

declare(strict_types=1);

namespace tests\Time\InitialVersion;

use PHPUnit\Framework\TestCase;
use Time\InitialVersion\CurrentTime;

use function PHPUnit\Framework\greaterThan;
use function PHPUnit\Framework\greaterThanOrEqual;

class CurrentTimeTest extends TestCase
{
    protected CurrentTime $currentTime;
    protected function setUp(): void
    {
        $this->currentTime = new CurrentTime();
    }
    public function testGetBoundariesBetween0And23(): void
    {
        self::assertThat($this->currentTime->getTime(), constraint:  greaterThan(-1));
    }
}
