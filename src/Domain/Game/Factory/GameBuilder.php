<?php
namespace App\Domain\Game\Factory;

use App\Domain\Game\Model\Game;
use App\Domain\Game\Model\GameBoard;
use App\Domain\Game\Model\Player;

class GameBuilder implements GameBuilderInterface
{
    /**
     * @var Game
     */
    private $game;

    /**
     * GameBuilder constructor.
     */
    public function __construct()
    {
        $this->game = new Game();
    }


    public function addPlayerA(Player $playerA)
    {
        $this->game->addPlayerA($playerA);
        return $this;
    }

    public function addPlayerB(Player $playerB)
    {
        $this->game->addPlayerB($playerB);
        return $this;
    }

    public function drawBoard(GameBoard $gameBoard)
    {
        $this->game->addGameBoard($gameBoard);
        return $this;
    }

    public function setGameName(string $name)
    {
        $this->game->setName($name);
        return $this;
    }


    public function getGame() : Game {
        return $this->game;
    }

}