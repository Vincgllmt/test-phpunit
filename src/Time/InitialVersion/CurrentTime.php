<?php

declare(strict_types=1);

namespace Time\InitialVersion;

class CurrentTime
{
    public function getTime(): int
    {
        return (int)date('G');
    }
    public function getTimeOfDay(): string
    {
        $date = $this->getTime();
        switch ($date) {
            case ($date < 6):
                return "Night";
            case ($date >= 6 && $date < 12):
                return "Morning";
            case ($date >= 12 && $date < 18):
                return "Noon";
            default:
                return "Evening";
        }
    }
}
