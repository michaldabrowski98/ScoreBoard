<?php

namespace Mdabrowski\ScoreBoard\Collection;

use ArrayIterator;
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
}
