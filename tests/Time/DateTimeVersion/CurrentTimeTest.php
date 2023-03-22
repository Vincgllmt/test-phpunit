<?php

declare(strict_types=1);

namespace Time\DateTimeVersion;

use PHPUnit\Framework\TestCase;
use DateTime;

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
    public function timeDayProvider(): array
    {
        return [
            "time·set·to··1" => [1, 1],
            "time·set·to··3" => [3, 1],
            "time·set·to··5" => [5, 1],
            "time·set·to··6" => [6, 2],
            "time·set·to··8" => [8, 2],
            "time·set·to··11" => [11, 2],
            "time·set·to··12" => [12, 3],
            "time·set·to··14" => [14, 3],
            "time·set·to··17" => [17, 3],
            "time·set·to··18" => [18, 4],
            "time·set·to··21" => [21, 4],
            "time·set·to··23" => [23, 4],
        ];
    }

    /**
     * @param int $time
     * @param int $expected
     * @dataProvider timeDayProvider
     * @return void
     */
    public function testGetTimeOfDay(int $time, int $expected): void
    {
        $mock = $this->createPartialMock(CurrentTime::class, ['getDateTime']);
        $stub = $this->createStub(DateTime::class);
        $stub->method('format')->with('H')->willReturn((string)$time);
        $mock->method('getDateTime')->willReturn($stub);
        assertSame($expected, $mock->getTimeOfDay());
    }
    public function timeProvider(): array
    {
        return [
            "time set to 0" => [0,0],
            "time set to 3" => [3,3],
            "time set to 6" => [6,6],
            "time set to 12" => [12,12],
            "time set to 23" => [23,23],
        ];
    }

    /**
     * @param int $time
     * @param string $expected
     * @return void
     * @dataProvider timeProvider
     */
    public function testGetTime(int $time, int $expected): void
    {
        $mock = $this->createPartialMock(CurrentTime::class, ['getDateTime']);
        $date = new DateTime();
        $mock
            ->expects($this->once())
            ->method('getDateTime')
            ->willReturn($date->setTime($time, 0));
        assertSame($mock->getTime(), $expected);
    }
}
