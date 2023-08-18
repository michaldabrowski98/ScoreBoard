<?php

namespace Mdabrowski\ScoreBoard\Collection;

use ArrayIterator;
use Exception;
use IteratorAggregate;
use Mdabrowski\ScoreBoard\Entity\Game;
use Traversable;

class GameCollection implements IteratorAggregate
{
    /** @var Game[]  */
    private array $list = [];

    public function add(Game $game): void
    {
        $this->list[] = $game;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->list);
    }

    /**
     * @throws Exception
     */
    public function search(string $searchedHash): Game
    {
        foreach ($this->list as $game) {
            if (
                $searchedHash === $game->getUniqueHash()
                || $searchedHash === $game->getShortenedUniqueHash()
            ) {
                return $game;
            }
        }

        throw new Exception('Game not found');
    }
}
