<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 23:16
 */

namespace App\Domain\Game;

use App\Domain\Game\Entity\BoardGame;
use App\Domain\Game\Entity\Movement;

class BoardGameFactory
{

    /**
     * @param int $dimension
     * @return BoardGame
     */
    public function createEmptyBoard(int $dimension = BoardGame::BOARD_DIMENSION_DEFAULT) :BoardGame {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = Movement::EMPTY_MOVEMENT;
            }
        }
        return new BoardGame($board, $dimension);
    }


    /**
     * @param int $dimension
     * @param string $playerToken
     * @return BoardGame
     */
    public function createBoardFilledWithOnePlayerToken(int $dimension, string $playerToken) :BoardGame {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = $playerToken;
            }
        }
        return new BoardGame($board, $dimension);
    }



}