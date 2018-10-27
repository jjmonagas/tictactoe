<?php
namespace App\Domain\Game\Model;


/**
 * Class Game
 * @package App\Domain\Game\Model
 */
class Game
{
    /**
     * @var Player
     */
    protected $playerA;

    /**
     * @var Player
     */
    protected $playerB;

    /**
     * @var GameBoard
     */
    protected $gameBoard;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    public $hasEmptySlots;

    /**
     * @var string
     */
    public $playerAToken;

    /**
     * @var string
     */
    public $playerBToken;

    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->playerAToken = PlayerToken::PLAYER_TOKEN_X;
        $this->playerBToken = PlayerToken::PLAYER_TOKEN_O;
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
     * @return string
     */
    public function getPlayerAToken(): string
    {
        return $this->playerAToken;
    }

    /**
     * @return string
     */
    public function getPlayerBToken(): string
    {
        return $this->playerBToken;
    }


    /**
     * @return GameBoard
     */
    public function getGameBoard(): GameBoard
    {
        return $this->gameBoard;
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

    public function addGameBoard(GameBoard $gameBoard) {
        $this->gameBoard = $gameBoard;
    }

    public function start() {
        $this->hasEmptySlots = 0;
    }

    public function finish() {
        return $this->checkIfThereIsAWinner($this->getPlayerAToken()) || $this->checkIfThereIsAWinner($this->getPlayerBToken());
    }

    public function markCellWithAPlayerToken(int $coordinateX, int $coordinateY, string $playerToken) :bool {
        $this->gameBoard->markCellWithToken($coordinateX, $coordinateY, $playerToken);
        return $this->checkIfThereIsAWinner($playerToken);
    }


    public function checkIfThereIsAWinner(string $playerToken) :bool {
        return $this->winnerDiagonalMovements($playerToken) ||
            $this->winnerHorizontalOrVerticalMovements($playerToken);
    }


    /**
     * @return bool
     */
    public function hasFreeMovements() :bool {
        $boardDimension = $this->getGameBoard()->boardDimension;
        $board = $this->getGameBoard()->board;
        $freeMovements = 0;
        for ($n=0; $n < $boardDimension;$n++) {
            for($m=0; $m < $boardDimension; $m++) {
                if ($board[$n][$m] === GameBoard::BOARD_EMPTY_CELL) {
                    $freeMovements = true;
                    break;
                }
            }
            if ($freeMovements) break;
        }
        return $freeMovements;
    }

    /**
     * @param string $playerToken
     * @return bool
     */
    public function winnerHorizontalOrVerticalMovements(string $playerToken) :bool {
        $winner = false;
        $boardDimension = $this->getGameBoard()->boardDimension;
        $board = $this->getGameBoard()->board;
        for ($n = 0; $n < $boardDimension; $n++) {
            $playerTokensInHorizontalRow = 0;
            $playerTokensInVerticalRow = 0;
            for($m = 0; $m < $boardDimension; $m++) {
                if ($board[$n][$m] === $playerToken) { $playerTokensInHorizontalRow++; }
                if ($board[$m][$n] === $playerToken) { $playerTokensInVerticalRow++; }
            }
            if ($this->checkWinnerRow($playerTokensInHorizontalRow) || $this->checkWinnerRow($playerTokensInVerticalRow)) {
                $winner = true;
                break;
            }
        }
        return $winner;
    }

    public function winnerDiagonalMovements(string $playerToken) :bool {
        $boardDimension = $this->getGameBoard()->boardDimension;
        $board = $this->getGameBoard()->board;
        $playerTokensInFirstDiagonal = 0;
        $playerTokensInSecondDiagonal = 0;
        for ($n = 0; $n < $boardDimension; $n++) {
            if ($board[$n][$n] === $playerToken) {
                $playerTokensInFirstDiagonal++;
            }
            $mSecondDiagonal = ($boardDimension - 1) - $n;
            if ($board[$n][$mSecondDiagonal] === $playerToken) {
                $playerTokensInSecondDiagonal++;
            }
        }
        return $this->checkWinnerRow($playerTokensInFirstDiagonal) || $this->checkWinnerRow($playerTokensInSecondDiagonal);
    }

    public function checkWinnerRow(int $playerTokensInARow) :bool {
        return $playerTokensInARow === $this->getGameBoard()->boardDimension;
    }


}