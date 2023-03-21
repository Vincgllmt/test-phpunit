<?php

declare(strict_types=1);

namespace Time\DateTimeVersion;

class CurrentTime
{
    public const NIGHT = 1;
    public const MORNING = 2;
    public const NOON = 3;
    public const EVENING = 4;
    public function getTime(): int
    {
        return (int)date('G');
    }
    public function getTimeOfDay(): int
    {
        $date = $this->getTime();
        switch ($date) {
            case ($date < 6):
                return self::NIGHT;
            case ($date >= 6 && $date < 12):
                return self::MORNING;
            case ($date >= 12 && $date < 18):
                return self::NOON;
            default:
                return self::EVENING;
        }
    }
    public function getDateTime(): \DateTime
    {
        return new \DateTime();
    }
}
