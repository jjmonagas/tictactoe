<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 21:08
 */

namespace App\Domain\Game\Entity;

use App\Domain\User\Entity\User;

/**
 * Class Game
 * @package App\Model
 */
class Game
{
    public const BOARD_DIMENSION_DEFAULT = 3;

    public const USER_A_TOKEN = 'X';
    public const USER_B_TOKEN = 'O';

    public const NO_USER_TOKEN = '-';

    /**
     * @var User
     */
    protected $playerA;

    /**
     * @var User
     */
    protected $playerB;

    /**
     * @var array
     */
    protected $board;

    /**
     * @var int
     */
    protected $boardDimension;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    public $hasEmptySlots;



    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->boardDimension = self::BOARD_DIMENSION_DEFAULT;
        $this->board = [];
    }

    /**
     * @return User
     */
    public function getPlayerA(): User
    {
        return $this->playerA;
    }

    /**
     * @param User $playerA
     * @return Game
     */
    public function setPlayerA(User $playerA): Game
    {
        $this->playerA = $playerA;
        return $this;
    }

    /**
     * @return User
     */
    public function getPlayerB(): User
    {
        return $this->playerB;
    }

    /**
     * @param User $playerB
     * @return Game
     */
    public function setPlayerB(User $playerB): Game
    {
        $this->playerB = $playerB;
        return $this;
    }

    /**
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param array $board
     * @return Game
     */
    public function setBoard(array $board): Game
    {
        $this->board = $board;
        return $this;
    }

    /**
     * @return int
     */
    public function getBoardDimension(): int
    {
        return $this->boardDimension;
    }

    /**
     * @param int $boardDimension
     * @return Game
     */
    public function setBoardDimension(int $boardDimension): Game
    {
        $this->boardDimension = $boardDimension;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Game
     */
    public function setName(string $name): Game
    {
        $this->name = $name;
        return $this;
    }


    public function start() {
        $this->hasEmptySlots = 0;
    }

    public function finish() {

    }


}