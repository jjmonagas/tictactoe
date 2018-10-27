# tictactoe [![Build Status](https://travis-ci.org/jjmonagas/tictactoe.svg?branch=master)](https://travis-ci.org/jjmonagas/tictactoe)
TIC TAC TOE as a service - Domain Driven Design

## Requirements

* PHP 7.1.3 or higher;

## Installation

```
git clone https://github.com/jjmonagas/tictactoe.git
cd tictactoe/
composer install
```

## Usage

```
cd tictactoe/
```

##### Create users 
```
php bin/console tictactoe:create-user Charles
```

##### Delete users 
```
php bin/console tictactoe:delete-user Charles
```

##### Start a new game between two users (Default board dimension 3x3)
```
php bin/console tictactoe:play:start Charles Mary 'Mi Tic tac'
```


##### Start a new game between two users (Board dimension 5x5)
```
php bin/console tictactoe:play:tart Charles Mary 'Mi Tic tac' -d 5
```

##### Start a new game between two users (Invalid Board dimension 2x2)
```
php bin/console tictactoe:play:start Charles Mary 'Mi Tic tac' -d 2
```

##### A user doing a move in a game
```
php bin/console tictactoe:mark:cell Mary 'Mi Tic Tac Board' 1 2
```

##### To know if a game has finished and if there is a winner (No winner, No finished)
```
php bin/console tictactoe:check:finished:winner Charles Mary 'My Tic Tac' 
```

##### To know if a game has finished and if there is a winner (User A wins 'Charles')
```
php bin/console tictactoe:check:finished:winner Charles Mary 'My Tic Tac' -w A
```

##### To know if a game has finished and if there is a winner (User B wins 'Mary')
```
php bin/console tictactoe:check:finished:winner Charles Mary 'My Tic Tac' -w B
```

##### To know if a game has finished and if there is a winner (Finished, nobody wins)
```
php bin/console tictactoe:check:finished:winner Charles Mary 'My Tic Tac' -w 0
```



## Tests with Symfony PHPUnit Testing Framework

```
cd tictactoe/
```

##### Run all tests
```
php bin/phpunit 
```

##### Run Functional Command test
```
php bin/phpunit tests/Command/TictactoeCheckFinishedWinnerCommandTest.php
```

##### Run Unit tests GAME
```
php bin/phpunit tests/Domain/Game/Factory/GameBoardFactoryTest.php
php bin/phpunit tests/Domain/Game/Factory/GameBuilderTest.php
php bin/phpunit tests/Domain/Game/Model/GameBoardTest.php
php bin/phpunit tests/Domain/Game/Model/GameTest.php
php bin/phpunit tests/Domain/Game/GameServiceTest.php
```

##### Run Unit tests USER
```
php bin/phpunit tests/Domain/User/Factory/UserFactoryTest.php
php bin/phpunit tests/Domain/User/UserServiceTest.php
```
