<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 21:08
 */

namespace App\Model;

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
    protected $userA;

    /**
     * @var User
     */
    protected $userB;

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
    public function getUserA(): User
    {
        return $this->userA;
    }

    /**
     * @param User $userA
     * @return Game
     */
    public function setUserA(User $userA): Game
    {
        $this->userA = $userA;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserB(): User
    {
        return $this->userB;
    }

    /**
     * @param User $userB
     * @return Game
     */
    public function setUserB(User $userB): Game
    {
        $this->userB = $userB;
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
}