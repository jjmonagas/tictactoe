<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 10/10/18
 * Time: 1:36
 */

namespace App\Services;


use App\Model\Game;
use App\Model\Movement;
use App\Model\User;

interface MovementInterface
{
    public function makeMovement(User $user, Game $game, int $coordinateX, int $coordinateY) :Movement;
    public function isUserWinner(Game $game, User $user) :bool;
    public function hasFreeMovements(Game $game) :bool;
}