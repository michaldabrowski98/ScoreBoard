<?php

namespace Mdabrowski\ScoreBoard\Entity;

use DateInterval;
use DateTime;

class Game
{
    private string $uniqueHash;
    private string $homeTeamName;
    private string $awayTeamName;
    private int $homeTeamScore;
    private int $awayTeamScore;
    private DateTime $startTime;
    private ?DateTime $endTime = null;
    private bool $isOver = false;
    public function __construct(
        string $homeTeamName,
        string $awayTeamName
    ) {

        $this->homeTeamName = $homeTeamName;
        $this->awayTeamName = $awayTeamName;
        $this->homeTeamScore = 0;
        $this->awayTeamScore = 0;
        $this->startTime = new DateTime('NOW');
        $this->generateUniqueHash();
    }

    public function __toString(): string
    {
        return sprintf(
            '%s\t%s : %s\t%s : %s\t%s',
            $this->getShortenedUniqueHash(),
            $this->homeTeamName,
            $this->awayTeamName,
            $this->homeTeamScore,
            $this->awayTeamScore,
            $this->getFormattedGameTime()
        );
    }

    public function getUniqueHash(): string
    {
        return $this->uniqueHash;
    }

    public function getShortenedUniqueHash(): string
    {
        return substr($this->uniqueHash, 0, 5);
    }

    private function generateUniqueHash(): void {
        $this->uniqueHash = md5(
            sprintf(
                '%s%s%s',
                $this->homeTeamName,
                $this->awayTeamName,
                $this->startTime->format('Y-m-d H:i:s')
            )
        );
    }

    private function getFormattedGameTime(): string
    {
        if (null === $gameTime = $this->getGameTime()) {
            return 'Still going';
        }

        return sprintf('%s:%s', $gameTime->h, $gameTime->i);
    }

    private function getGameTime(): ?DateInterval
    {
        return $this->endTime?->diff($this->startTime);
    }
}