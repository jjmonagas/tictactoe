<?php
namespace App\Domain\Game\Factory;

use App\Domain\Game\Model\GameBoard;

class GameBoardFactory
{

    /**
     * @param int $dimension
     * @return GameBoard
     */
    public function createEmptyBoard(int $dimension = GameBoard::BOARD_DIMENSION_DEFAULT) :GameBoard {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = GameBoard::BOARD_EMPTY_CELL;
            }
        }
        return new GameBoard($board, $dimension);
    }


    /**
     * @param int $dimension
     * @param string $playerToken
     * @return GameBoard
     */
    public function createBoardFilledWithOnePlayerToken(int $dimension, string $playerToken) :GameBoard {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = $playerToken;
            }
        }
        return new GameBoard($board, $dimension);
    }



}