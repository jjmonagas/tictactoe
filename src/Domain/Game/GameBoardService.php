<?php
namespace App\Domain\Game;


use App\Domain\Game\Model\GameBoard;

class GameBoardService
{

    public function markAllCellsWithPlayerToken(GameBoard $gameBoard, string $playerToken) {
        $dimension = $gameBoard->boardDimension;
        for ($n=0;$n<$dimension;$n++) {
            for($m=0;$m<$dimension;$m++){
                $gameBoard->markCellWithToken($n, $m, $playerToken);
            }
        }
    }
}