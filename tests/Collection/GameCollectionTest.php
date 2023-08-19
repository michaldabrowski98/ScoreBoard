<?php

namespace Mdabrowski\ScoreBoard\Collection;

use DateTime;
use Mdabrowski\ScoreBoard\Entity\Game;
use Mdabrowski\ScoreBoard\Exception\GameOverException;
use PHPUnit\Framework\TestCase;

final class GameCollectionTest extends TestCase
{
    public function testLastResultNullWhenCollectionIsEmpty(): void
    {
        $gameCollection = new GameCollection();

        $result = $gameCollection->last();
        $this->assertNull($result);
    }

    public function testLastReturnsLastElementOfTheList(): void
    {
        $gameCollection = new GameCollection();

        $firstGame = new Game('Team A', 'Team B', new DateTime());
        $secondGame = new Game('Team C', 'Team D', new DateTime());

        $gameCollection->add($firstGame);
        $gameCollection->add($secondGame);

        $result = $gameCollection->last();
        $this->assertEquals($secondGame, $result);
    }

    public function testIsLastGameStillGoingReturnsFalseIfEmptyList(): void
    {
        $gameCollection = new GameCollection();

        $result = $gameCollection->isLastGameStillGoing();
        $this->assertFalse($result);
    }

    public function testIsLastGameStillGoingReturnsFalseIfGameIsOver(): void
    {
        $gameCollection = new GameCollection();

        $firstGame = new Game('Team A', 'Team B', new DateTime());
        $firstGame->endGame(new DateTime());

        $gameCollection->add($firstGame);

        $result = $gameCollection->isLastGameStillGoing();
        $this->assertFalse($result);
    }

    public function testIsLastGameStillGoingReturnsTrueIfLastGameIsNotOver(): void
    {
        $gameCollection = new GameCollection();

        $firstGame = new Game('Team A', 'Team B', new DateTime());

        $gameCollection->add($firstGame);

        $result = $gameCollection->isLastGameStillGoing();
        $this->assertTrue($result);
    }

    public function testGetCurrentGameThrowsExceptionIfGameListIsEmpty(): void
    {
        $gameCollection = new GameCollection();

        $this->expectException(GameOverException::class);
        $this->expectExceptionMessage('There is no active game on scoreboard');

        $gameCollection->getCurrentGame();
    }

    public function testGetCurrentGameThrowsExceptionIfCurrentGameIsOver(): void
    {
        $gameCollection = new GameCollection();

        $firstGame = new Game('Team A', 'Team B', new DateTime());
        $firstGame->endGame(new DateTime());

        $this->expectException(GameOverException::class);
        $this->expectExceptionMessage('There is no active game on scoreboard');

        $gameCollection->getCurrentGame();
    }

    public function testGetCurrentGameReturnsCurrentGame(): void
    {
        $gameCollection = new GameCollection();

        $firstGame = new Game('Team A', 'Team B', new DateTime());
        $firstGame->endGame(new DateTime());
        $secondGame = new Game('Team C', 'Team D', new DateTime());

        $gameCollection->add($firstGame);
        $gameCollection->add($secondGame);

        $result = $gameCollection->getCurrentGame();
        $this->assertEquals($result, $secondGame);
    }
}
