<?php

declare(strict_types=1);

namespace Time\TimestampVersion;

use PHPUnit\Framework\TestCase;
use Time\InitialVersion\CurrentTime;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\greaterThan;

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
    public function timeProvider(): array
    {
        return [
            "time·set·to··1" => [1, "Night"],
            "time·set·to··3" => [3, "Night"],
            "time·set·to··5" => [5, "Night"],
            "time·set·to··6" => [6, "Morning"],
            "time·set·to··8" => [8, "Morning"],
            "time·set·to··11" => [11, "Morning"],
            "time·set·to··12" => [12, "Noon"],
            "time·set·to··14" => [14, "Noon"],
            "time·set·to··17" => [17, "Noon"],
            "time·set·to··18" => [18, "Evening"],
            "time·set·to··21" => [21, "Evening"],
            "time·set·to··23" => [23, "Evening"],
        ];
    }

    /**
     * @param int $time
     * @param string $expected
     * @dataProvider timeProvider
     * @return void
     */
    public function testGetTimeOfDay(int $time, string $expected): void
    {
        $mock = $this->createPartialMock(CurrentTime::class, ['getTime']);
        $mock->method('getTime')->willReturn($time);
        assertSame($mock->getTimeOfDay(), $expected);
    }
}