<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 27/10/18
 * Time: 11:00
 */

namespace Domain\Game\Model;


use App\Domain\Game\Factory\GameBoardFactory;
use App\Domain\Game\Model\PlayerToken;
use PHPUnit\Framework\TestCase;

class GameBoardTest extends TestCase
{

    public function testMarkCell() {
        $gameBoardFactory = new GameBoardFactory();
        $gameboard = $gameBoardFactory->createEmptyBoard(5);

        $gameboard->markCellWithToken(3,4,PlayerToken::PLAYER_TOKEN_X);

        self::assertEquals(PlayerToken::PLAYER_TOKEN_X, $gameboard->getPlayerTokenAt(3,4));
    }

}