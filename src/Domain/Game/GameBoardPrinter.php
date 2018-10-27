<?php
namespace App\Domain\Game;


use App\Domain\Game\Model\GameBoard;

class GameBoardPrinter
{

    /**
     * @param GameBoard $gameBoard
     */
    public function printBoard(GameBoard $gameBoard) :void {
        $board = $gameBoard->board;
        $dimension = $gameBoard->boardDimension;
        for($n=0; $n<$dimension; $n++) {
            $row = '';
            for($m=0; $m<$dimension; $m++) {
                $row .= $board[$n][$m] . ' | ';
            }
            printf($row . PHP_EOL);
        }
    }

}