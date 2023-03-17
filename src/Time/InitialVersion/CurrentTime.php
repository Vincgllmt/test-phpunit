<?php

declare(strict_types=1);
namespace Time;
class CurrentTime
{
    public function getTime(): int
    {
        return (int)date('G');
    }
}