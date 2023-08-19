<?php

namespace Mdabrowski\ScoreBoard\Manager;

use DateTime;
use Mdabrowski\ScoreBoard\Collection\GameCollection;
use Mdabrowski\ScoreBoard\Entity\Game;
use Mdabrowski\ScoreBoard\Exception\GameOverException;
use Mdabrowski\ScoreBoard\Exception\GameStillGoingException;

class GameManager implements GameManagerInterface
{
    private GameCollection $collection;

    public function __construct()
    {
        $this->collection = new GameCollection();
    }

    /**
     * @throws GameStillGoingException
     */
    public function startGame(
        string $homeTeamName,
        string $awayTeamName
    ): void {
        if ($this->collection->isLastGameStillGoing()) {
            throw new GameStillGoingException('Game is not over you can not start new game');
        }

        $this->collection->add(
            new Game(
                $homeTeamName,
                $awayTeamName,
                new DateTime()
            )
        );
    }

    /**
     * @throws GameOverException
     */
    public function endGame(): void
    {
        $currentGame = $this->collection->getCurrentGame();
        $currentGame->endGame(new DateTime());
    }

    /**
     * @throws GameOverException
     */
    public function updateGameScore(
        int $homeTeamScore,
        int $awayTeamScore
    ): void
    {
        $currentGame = $this->collection->getCurrentGame();

        $currentGame->setHomeTeamScore($homeTeamScore);
        $currentGame->setAwayTeamScore($awayTeamScore);
    }

    /**
     * @return Game[]
     */
    public function getAllGames(): array
    {
        return array_reverse($this->collection->toArray());
    }
}
