# tictactoe [![Build Status](https://travis-ci.org/jjmonagas/tictactoe.svg?branch=master)](https://travis-ci.org/jjmonagas/tictactoe)
TIC TAC TOE as a service
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
php bin/console tictactoe:play Charles Mary 'Mi Tic tac'
```


##### Start a new game between two users (Board dimension 5x5)
```
php bin/console tictactoe:play Charles Mary 'Mi Tic tac' -d 5
```

##### Start a new game between two users (Invalid Board dimension 2x2)
```
php bin/console tictactoe:play Charles Mary 'Mi Tic tac' -d 2
```

##### A user doing a move in a game
```
php bin/console tictactoe:movement Mary 'Mi Tic Tac Board' 1 2
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

##### Run Unit test (Check Create User by username)
```
php bin/phpunit tests/Utils/UserFactoryTest.php
```


## Where to find my code

This is a Symfony4 project with its new directory structure:

* /src -->  Source code
* /src/Command/TictactoeCreateUserCommand.php --> Command line Use Case 'Create users'
* /src/Command/TictactoeDeleteUserCommand.php --> Command line Use Case 'Delete users'
* /src/Command/TictactoePlayCommand.php --> Command line Use Case 'Start a new game between two users'
* /src/Command/TictactoeMovementCommand.php --> Command line Use Case 'A user doing a move in a game'
* /src/Command/TictactoeCheckFinishedWinnerCommand.php --> Command line Use Case 'To know if a game has finished and if there is a winner'
* /src/Model/ --> Data Models
* /src/Services/ --> Symfony services and interfaces for API
* /src/Utils/ --> Helpers and Factories and Builders
* /tests --> Unit and Functional tests code
