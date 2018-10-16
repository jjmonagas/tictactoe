<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 10/10/18
 * Time: 1:34
 */

namespace App\Domain\Game;



use App\Domain\Game\Entity\Game;
use App\Utils\GameBuilderInterface;

interface GameInterface
{
    public function startNewGame(string $usernameA, string $usernameB, string $gameName, int $boardDimension, GameBuilderInterface $gameBuilder) :Game;
    public function findUserTokenByUsername(Game $game, string $username) :string;
    public function getGame(string $gameName) :Game;
}