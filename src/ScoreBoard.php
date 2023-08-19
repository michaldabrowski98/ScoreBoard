<?php

namespace Mdabrowski\ScoreBoard;

use Mdabrowski\ScoreBoard\Exception\GameOverException;
use Mdabrowski\ScoreBoard\Exception\GameStillGoingException;
use Mdabrowski\ScoreBoard\Manager\GameManagerInterface;

class ScoreBoard
{
    private GameManagerInterface $gameManager;

    public function __construct(GameManagerInterface $gameManager)
    {
        $this->gameManager = $gameManager;
    }

    /**
     * @throws GameStillGoingException
     */
    public function startGame(
        string $homeTeamName,
        string $awayTeamName
    ): void {
        $this->gameManager->startGame(
            $homeTeamName,
            $awayTeamName
        );
    }

    /**
     * @throws GameOverException
     */
    public function endGame(): void
    {
        $this->gameManager->endGame();
    }

    /**
     * @throws GameOverException
     */
    public function updateScore(
        int $homeTeamScore,
        int $awayTeamScore
    ): void {
        $this->gameManager->updateGameScore(
            $homeTeamScore,
            $awayTeamScore
        );
    }

    public function showAllMatchesSummation(): void
    {
        $gameNumber = 1;
        foreach ($this->gameManager->getAllGames() as $game) {
            echo sprintf('%s. %s', $gameNumber, $game);
            $gameNumber++;
        }
    }
}
