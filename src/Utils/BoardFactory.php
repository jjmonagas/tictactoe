<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 23:16
 */

namespace App\Utils;

use App\Domain\Game\Entity\Movement;

class BoardFactory
{

    public function createBoard(int $dimension) {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = Movement::EMPTY_MOVEMENT;
            }
        }
        return $board;
    }


    public function createBoardWithToken(int $dimension, string $userToken) {
        $board = null;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $board[$n][$m] = $userToken;
            }
        }
        return $board;
    }



}