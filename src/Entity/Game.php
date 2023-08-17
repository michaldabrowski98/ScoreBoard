<?php

namespace Mdabrowski\ScoreBoard\Entity;

class Game
{
    private string $homeTeamName;
    private string $awayTeamName;
    private int $homeTeamScore;
    private int $awayTeamScore;
    private bool $gameStarted;
    private bool $gameEnded;
    public function __construct(
        string $homeTeamName,
        string $awayTeamName
    ) {
        $this->homeTeamName = $homeTeamName;
        $this->awayTeamName = $awayTeamName;
        $this->homeTeamScore = 0;
        $this->awayTeamScore = 0;
    }
}