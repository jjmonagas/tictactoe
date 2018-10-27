<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 27/10/18
 * Time: 12:25
 */

namespace Domain\Game\Factory;


use App\Domain\Game\Factory\GameBoardFactory;
use App\Domain\Game\Factory\GameBuilder;
use App\Domain\Game\Model\Game;
use App\Domain\Game\Model\GameBoard;
use App\Domain\Game\Model\Player;
use App\Domain\User\Model\User;
use PHPUnit\Framework\TestCase;

class GameBuilderTest extends TestCase
{

    public function testCreateGameWithBuilder() {
        $gameBuilder = new GameBuilder();

        $playerA = new User('John');
        $playerB = new User('Mary');

        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard();

        $gameName = 'Tic Tac Toe Test';

        $gameBuilder->addPlayerA($playerA);
        $gameBuilder->addPlayerB($playerB);
        $gameBuilder->drawBoard($gameBoard);
        $gameBuilder->setGameName($gameName);
        $newGame = $gameBuilder->getGame();

        self::assertInstanceOf(Game::class, $newGame);
        self::assertInstanceOf(Player::class, $newGame->getPlayerA());
        self::assertInstanceOf(Player::class, $newGame->getPlayerB());
        self::assertInstanceOf(GameBoard::class, $newGame->getGameBoard());
        self::assertEquals($gameName, $newGame->getName());

    }

}