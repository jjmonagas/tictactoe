<?php
namespace App\Domain\Game\Model;


class GameBoard
{
    public const BOARD_DIMENSION_DEFAULT = 3;
    public const BOARD_EMPTY_CELL = ' ';

    /**
     * @var array
     */
    public $board;

    /**
     * @var int
     */
    public $boardDimension;

    /**
     * GameBoard constructor.
     * @param array $board
     * @param int $boardDimension
     */
    public function __construct(array $board, int $boardDimension)
    {
        $this->board = $board;
        $this->boardDimension = $boardDimension;
    }


    public function markCellWithToken(int $coordinateX, int $coordinateY, string $token) :void {
        if ($this->board[$coordinateX][$coordinateY] === self::BOARD_EMPTY_CELL) {
            $this->board[$coordinateX][$coordinateY] = $token;
        }
    }

    public function getPlayerTokenAt(int $coordinateX, int $coordinateY) :string {
        return $this->board[$coordinateX][$coordinateY];
    }


}