<?php

namespace Mdabrowski\ScoreBoard\Manager;

use Mdabrowski\ScoreBoard\Collection\GameCollection;
use Mdabrowski\ScoreBoard\Entity\Game;
use PHPUnit\Framework\TestCase;
use ReflectionObject;

final class GameManagerTest extends TestCase
{
    public function testStartGame(): void
    {
        $gameManager = new GameManager();
        $gameManager->startGame('teamA', 'teamB');
        $reflectedExample = new ReflectionObject($gameManager);
        $gameCollectionProperty = $reflectedExample->getProperty('collection');
        $gameCollectionProperty->setAccessible(true);

        $expectedGameCollection = new GameCollection();
        $expectedGameCollection->add(new Game('teamA', 'teamB'));
        $this->assertEquals($expectedGameCollection, $gameCollectionProperty->getValue($gameManager));
    }
}