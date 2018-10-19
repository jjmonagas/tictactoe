<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 17/10/18
 * Time: 10:18
 */

namespace App\Domain\Game\Entity;


class BoardGame
{
    public const BOARD_DIMENSION_DEFAULT = 3;

    /**
     * @var array
     */
    public $board;

    /**
     * @var int
     */
    public $boardDimension;

    /**
     * BoardGame constructor.
     * @param array $board
     * @param int $boardDimension
     */
    public function __construct(array $board, int $boardDimension)
    {
        $this->board = $board;
        $this->boardDimension = $boardDimension;
    }


}