<?php
namespace App\Domain\Game\Factory;


use App\Domain\Game\Model\Game;
use App\Domain\Game\Model\GameBoard;
use App\Domain\Game\Model\Player;

interface GameBuilderInterface
{
    public function addPlayerA(Player $playerA);

    public function addPlayerB(Player $playerB);

    public function drawBoard(GameBoard $gameBoard);

    public function setGameName(string $gameName);

    public function getGame() : Game;
}