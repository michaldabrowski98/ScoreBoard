# ScoreBoard

ScoreBoard is simple PHP library that can be used to track football match score.

## Requirements

 - PHP 8.0 or higher
 - Composer

## Setup

To use library you need to copy files on your local machine using:
```
git clone https://github.com/michaldabrowski98/ScoreBoard
```
Then you need to go to ScoreBoard directory and perform command:
```
composer install
```
to install necessary dependencies.

## Getting started
#### Start game

To create new game you can use method:
```
Mdabrowski\ScoreBoard\ScoreBoard::startGame
```
method as arguments takes home team and away teams names. After start game score is always 0💯
#### Update game score

To update game score you can use method:
```
Mdabrowski\ScoreBoard\ScoreBoard::updateScore
```
which takes as arguments home team score and away team score (as integer numbers).
#### End game
To and current game you can use method
```
Mdabrowski\ScoreBoard\ScoreBoard::endGame
```

#### All games summation
To see all games summation you can use method:
```
Mdabrowski\ScoreBoard\ScoreBoard::showAllMatchesSummation
```
method will print scores to command line.
