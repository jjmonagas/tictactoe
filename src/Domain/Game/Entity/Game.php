<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 21:08
 */

namespace App\Domain\Game\Entity;


use App\Domain\Game\BoardGameFactory;

/**
 * Class Game
 * @package App\Domain\Game\Entity
 */
class Game
{

    public const PLAYER_A_TOKEN = 'X';
    public const PLAYER_B_TOKEN = 'O';

    public const NO_PLAYER_TOKEN = '-';

    /**
     * @var Player
     */
    protected $playerA;

    /**
     * @var Player
     */
    protected $playerB;

    /**
     * @var BoardGame
     */
    protected $boardGame;

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
    }

    /**
     * @return Player
     */
    public function getPlayerA(): Player
    {
        return $this->playerA;
    }

    /**
     * @param Player $playerA
     * @return Game
     */
    public function addPlayerA(Player $playerA): Game
    {
        $this->playerA = $playerA;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayerB(): Player
    {
        return $this->playerB;
    }

    /**
     * @param Player $playerB
     * @return Game
     */
    public function addPlayerB(Player $playerB): Game
    {
        $this->playerB = $playerB;
        return $this;
    }

    /**
     * @return BoardGame
     */
    public function getBoardGame(): BoardGame
    {
        return $this->boardGame;
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

    public function createBoardGame(int $dimension) {
        $boardFactory = new BoardGameFactory();
        $this->boardGame = $boardFactory->createEmptyBoard($dimension);
    }

    public function addBoardGame(BoardGame $boardGame) {
        $this->boardGame = $boardGame;
    }

    public function updateGameStatus(array $board) {
        $this->getBoardGame()->board = $board;
    }

    public function start() {
        $this->hasEmptySlots = 0;
    }

    public function finish() {

    }


}