<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 27/10/18
 * Time: 12:43
 */

namespace Domain\Game;


use App\Domain\Game\Factory\GameBoardFactory;
use App\Domain\Game\Factory\GameBuilder;
use App\Domain\Game\GameService;
use App\Domain\Game\Model\Game;
use App\Domain\Game\Model\GameBoard;
use App\Domain\Game\Model\Player;
use App\Domain\Game\Model\PlayerToken;
use App\Domain\User\Model\User;
use PHPUnit\Framework\TestCase;

class GameServiceTest extends TestCase
{

    public function testStartNewGame() {
        $gameBuilder = new GameBuilder();

        $playerA = new User('John');
        $playerB = new User('Mary');

        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard();

        $gameName = 'Tic Tac Toe Test';

        $gameService = new GameService($gameBuilder);

        $newGame = $gameService->startNewGame($playerA, $playerB, $gameName, $gameBoard);

        self::assertInstanceOf(Game::class, $newGame);
        self::assertInstanceOf(Player::class, $newGame->getPlayerA());
        self::assertInstanceOf(Player::class, $newGame->getPlayerB());
        self::assertInstanceOf(GameBoard::class, $newGame->getGameBoard());
        self::assertEquals($gameName, $newGame->getName());
    }


    public function testFindPlayerTokenByUsername() {
        $gameBuilder = new GameBuilder();

        $playerA = new User('john');
        self::assertEquals('john', $playerA->getUsername());

        $playerB = new User('mary');
        self::assertEquals('mary', $playerB->getUsername());

        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard();

        $gameName = 'Tic Tac Toe Test';

        $gameService = new GameService($gameBuilder);

        $newGame = $gameService->startNewGame($playerA, $playerB, $gameName, $gameBoard);

        self::assertEquals(PlayerToken::PLAYER_TOKEN_X, $gameService->findPlayerTokenByUsername($newGame, $playerA->getUsername()));
        self::assertEquals(PlayerToken::PLAYER_TOKEN_O, $gameService->findPlayerTokenByUsername($newGame, $playerB->getUsername()));
    }

    /**
     * @dataProvider gameNamesProvider
     */
    public function testFindGame(string $gameName) {
        $gameBuilder = new GameBuilder();
        $gameService = new GameService($gameBuilder);

        $game = $gameService->findGameByName($gameName);

        self::assertEquals($gameName, $game->getName());
    }

    public function gameNamesProvider() {
        return [
            ['My Tic Tac Toe'],
            ['Best Tic Tac Toe Ever'],
            ['Tic Tic Tac Tac Toes']
        ];
    }



}