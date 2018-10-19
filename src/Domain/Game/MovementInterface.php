<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 10/10/18
 * Time: 1:36
 */

namespace App\Domain\Game;

use App\Domain\Game\Entity\Game;
use App\Domain\Game\Entity\Movement;
use App\Domain\Game\Entity\Player;

interface MovementInterface
{
    public function makeMovement(Player $player, Game $game, int $coordinateX, int $coordinateY) :Movement;
    public function isPlayerWinner(Game $game, Player $player) :bool;
    public function hasFreeMovements(Game $game) :bool;
}