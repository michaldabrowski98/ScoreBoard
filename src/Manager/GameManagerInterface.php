<?php

namespace Mdabrowski\ScoreBoard\Manager;

use Mdabrowski\ScoreBoard\Entity\Game;
use Mdabrowski\ScoreBoard\Exception\GameOverException;
use Mdabrowski\ScoreBoard\Exception\GameStillGoingException;

interface GameManagerInterface
{
    /**
     * @throws GameStillGoingException
     */
    public function startGame(
        string $homeTeamName,
        string $awayTeamName
    ): void;

    /**
     * @throws GameOverException
     */
    public function endGame(): void;

    /**
     * @throws GameOverException
     */
    public function updateGameScore(
        int $homeTeamScore,
        int $awayTeamScore
    ): void;


    /**
     * @return Game[]
     */
    public function getAllGames(): array;
}
