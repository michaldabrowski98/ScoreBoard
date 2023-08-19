<?php

namespace Mdabrowski\ScoreBoard\Manager;

use Mdabrowski\ScoreBoard\Exception\GameStillGoingException;
use PHPUnit\Framework\TestCase;

final class GameManagerTest extends TestCase
{
    public function testStartGameThrowsExceptionIfGameIsStillGoing(): void
    {
        $gameManager = new GameManager();

        $this->expectException(GameStillGoingException::class);
        $this->expectExceptionMessage('Game is not over you can not start new game');

        $gameManager->startGame('Team A', 'Team B');
        $gameManager->startGame('Team C', 'Team D');
    }

    public function testStartGameWhenGameCollectionIsEmpty(): void
    {
        $homeTeamName = 'Team A';
        $awayTeamName = 'Team B';

        $gameManager = new GameManager();
        $gameManager->startGame($homeTeamName, $awayTeamName);

        $allGames = $gameManager->getAllGames();

        $this->assertCount(1, $allGames);
        $this->assertEquals($homeTeamName, $allGames[0]->getHomeTeamName());
        $this->assertEquals($awayTeamName, $allGames[0]->getAwayTeamName());
        $this->assertEquals(0, $allGames[0]->getHomeTeamScore());
        $this->assertEquals(0, $allGames[0]->getAwayTeamScore());
    }

    public function testEndGameSetGameIsOver(): void
    {
        $homeTeamName = 'Team A';
        $awayTeamName = 'Team B';

        $gameManager = new GameManager();
        $gameManager->startGame($homeTeamName, $awayTeamName);

        $gameManager->endGame();

        $allGames = $gameManager->getAllGames();

        $this->assertCount(1, $allGames);
        $this->assertTrue($allGames[0]->isGameOver());
    }

    public function testUpdateGameStatusChangesCurrentGameScore(): void
    {
        $homeTeamName = 'Team A';
        $awayTeamName = 'Team B';

        $gameManager = new GameManager();
        $gameManager->startGame($homeTeamName, $awayTeamName);

        $gameManager->updateGameScore(3, 5);

        $allGames = $gameManager->getAllGames();

        $this->assertCount(1, $allGames);
        $this->assertEquals(3, $allGames[0]->getHomeTeamScore());
        $this->assertEquals(5, $allGames[0]->getAwayTeamScore());
    }

    public function testGetAllGamesReturnsReverseGameCollection(): void
    {
        $gameManager = new GameManager();
        $gameManager->startGame('Team A', 'Team B');
        $gameManager->endGame();

        $gameManager->startGame('Team C', 'Team D');
        $gameManager->endGame();

        $allGames = $gameManager->getAllGames();
        $this->assertCount(2, $allGames);
        $this->assertEquals('Team C', $allGames[0]->getHomeTeamName());
        $this->assertEquals('Team D', $allGames[0]->getAwayTeamName());
        $this->assertEquals('Team A', $allGames[1]->getHomeTeamName());
        $this->assertEquals('Team B', $allGames[1]->getAwayTeamName());
    }
}
