<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 23:16
 */

namespace App\Domain\Game;

use App\Domain\Game\Entity\Movement;

class BoardFactory
{

    public function createEmptyBoard(int $dimension) {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = Movement::EMPTY_MOVEMENT;
            }
        }
        return $board;
    }


    public function createBoardFilledWithOnePlayerToken(int $dimension, string $playerToken) {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = $playerToken;
            }
        }
        return $board;
    }



}