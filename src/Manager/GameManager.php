<?php

namespace Mdabrowski\ScoreBoard\Manager;

use Mdabrowski\ScoreBoard\Collection\GameCollection;
use Mdabrowski\ScoreBoard\Entity\Game;

class GameManager
{
    private GameCollection $collection;

    public function __construct()
    {
        $this->collection = new GameCollection();
    }

    public function startGame(
        string $homeTeamName,
        string $awayTeamName
    ): void {
        $this->collection->add(
            new Game(
                $homeTeamName,
                $awayTeamName
            )
        );
    }
}
