<?php

namespace Mdabrowski\ScoreBoard\Entity;

use DateTime;

class Game
{
    private string $homeTeamName;
    private string $awayTeamName;
    private int $homeTeamScore;
    private int $awayTeamScore;
    private DateTime $startTime;
    private ?DateTime $endTime = null;
    public function __construct(
        string $homeTeamName,
        string $awayTeamName,
        DateTime $startTime
    ) {

        $this->homeTeamName = $homeTeamName;
        $this->awayTeamName = $awayTeamName;
        $this->homeTeamScore = 0;
        $this->awayTeamScore = 0;
        $this->startTime = $startTime;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s %s - %s %s%s',
            $this->homeTeamName,
            $this->homeTeamScore,
            $this->awayTeamName,
            $this->awayTeamScore,
            PHP_EOL
        );
    }

    public function endGame(DateTime $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function isGameOver(): bool
    {
        return null !== $this->endTime;
    }

    public function getHomeTeamName(): string
    {
        return $this->homeTeamName;
    }

    public function getAwayTeamName(): string
    {
        return $this->awayTeamName;
    }

    public function setAwayTeamScore(int $awayTeamScore): void
    {
        $this->awayTeamScore = $awayTeamScore;
    }

    public function getHomeTeamScore(): int
    {
        return $this->homeTeamScore;
    }

    public function setHomeTeamScore(int $homeTeamScore): void
    {
        $this->homeTeamScore = $homeTeamScore;
    }

    public function getAwayTeamScore(): int
    {
        return $this->awayTeamScore;
    }
}
