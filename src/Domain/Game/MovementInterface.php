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
use App\Domain\User\Entity\User;

interface MovementInterface
{
    public function makeMovement(User $user, Game $game, int $coordinateX, int $coordinateY) :Movement;
    public function isUserWinner(Game $game, User $user) :bool;
    public function hasFreeMovements(Game $game) :bool;
}