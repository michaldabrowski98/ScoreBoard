<?php

namespace Mdabrowski\ScoreBoard\Collection;

use ArrayIterator;
use IteratorAggregate;
use Mdabrowski\ScoreBoard\Entity\Game;
use Mdabrowski\ScoreBoard\Exception\GameOverException;
use Traversable;

class GameCollection implements IteratorAggregate
{
    /** @var Game[] */
    private array $gameList = [];

    public function add(Game $game): void
    {
        $this->gameList[] = $game;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->gameList);
    }

    public function toArray(): array
    {
        return $this->gameList;
    }

    /**
     * @throws GameOverException
     */
    public function getCurrentGame(): Game
    {
        $currentGame = $this->last();
        if ($this->isCurrentGameNotActive($currentGame)) {
            throw new GameOverException('There is no active game on scoreboard');
        }

        return $currentGame;
    }

    public function isLastGameStillGoing(): bool
    {
        return null !== $this->last() && !$this->last()->isGameOver();
    }
    public function last(): ?Game
    {
        if (empty($this->gameList)) {
            return null;
        }

        return end($this->gameList);
    }

    private function isCurrentGameNotActive(?Game $currentGame): bool
    {
        return null === $currentGame || $currentGame->isGameOver();
    }
}
