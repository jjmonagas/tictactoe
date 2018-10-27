<?php
namespace App\Tests\Domain\Game\Model;

use App\Domain\Game\Factory\GameBoardFactory;
use App\Domain\Game\Model\Game;
use App\Domain\Game\Model\PlayerToken;
use PHPUnit\Framework\TestCase;


class GameTest extends TestCase
{


    public function testWinnerWithHorizontalRow() {
        $boardDimension = 3;
        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard($boardDimension);

        $game = new Game();
        $game->addGameBoard($gameBoard);

        $playerTokenWinner = PlayerToken::PLAYER_TOKEN_X;

        $game->getGameBoard()->markCellWithToken(1,0, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(1,1, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(1,2, $playerTokenWinner);

        self::assertTrue($game->checkIfThereIsAWinner($playerTokenWinner));
    }

    public function testWinnerWithVerticalRow() {
        $boardDimension = 3;
        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard($boardDimension);

        $game = new Game();
        $game->addGameBoard($gameBoard);

        $playerTokenWinner = PlayerToken::PLAYER_TOKEN_X;

        $game->getGameBoard()->markCellWithToken(0,1, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(1,1, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(2,1, $playerTokenWinner);

        self::assertTrue($game->checkIfThereIsAWinner($playerTokenWinner));
    }

    public function testWinnerWithDiagonalRow() {
        $boardDimension = 3;
        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard($boardDimension);

        $game = new Game();
        $game->addGameBoard($gameBoard);

        $playerTokenWinner = PlayerToken::PLAYER_TOKEN_X;

        $game->getGameBoard()->markCellWithToken(0,2, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(1,1, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(2,0, $playerTokenWinner);

        self::assertTrue($game->checkIfThereIsAWinner($playerTokenWinner));

        $game->getGameBoard()->markCellWithToken(0,0, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(1,1, $playerTokenWinner);
        $game->getGameBoard()->markCellWithToken(2,2, $playerTokenWinner);

        self::assertTrue($game->checkIfThereIsAWinner($playerTokenWinner));
    }

    public function testNoWinnerRow() {
        $boardDimension = 3;
        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard($boardDimension);

        $game = new Game();
        $game->addGameBoard($gameBoard);

        self::assertFalse($game->checkIfThereIsAWinner(PlayerToken::PLAYER_TOKEN_X));
    }
}