<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 10/10/18
 * Time: 1:34
 */

namespace App\Services;


use App\Model\Game;
use App\Utils\GameBuilderInterface;

interface GameInterface
{
    public function createNewGame(string $usernameA, string $usernameB, string $gameName, int $boardDimension, GameBuilderInterface $gameBuilder) :Game;
    public function findUserTokenByUsername(Game $game, string $username) :string;
    public function getGame(string $gameName) :Game;
}