<?php

namespace App\Tests\Domain\User;


use App\Domain\Game\Factory\GameBoardFactory;
use PHPUnit\Framework\TestCase;

class GameBoardFactoryTest extends TestCase
{

    /**
     * @dataProvider dimensionsProvider
     */
    public function testCreateBoardGame(int $dimension)
    {
        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard($dimension);
        $this->assertCount($dimension, $gameBoard->board);
    }

    public function dimensionsProvider() {
        return [
            [3],
            [6],
            [10]
            ];
    }
}
