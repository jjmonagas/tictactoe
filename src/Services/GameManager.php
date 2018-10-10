<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:56
 */

namespace App\Services;


use App\Model\Game;
use App\Utils\GameBuilderInterface;

class GameManager implements GameInterface
{
    /**
     * @param string $usernameA
     * @param string $usernameB
     * @param string $gameName
     * @param int $boardDimension
     * @param GameBuilderInterface $gameBuilder
     * @return mixed
     */
    public function createNewGame(string $usernameA, string $usernameB, string $gameName, int $boardDimension, GameBuilderInterface $gameBuilder) : Game
    {
        return $gameBuilder->addUserA($usernameA)
            ->addUserB($usernameB)
            ->createBoard($boardDimension)
            ->setName($gameName)
            ->getGame();
    }

    /**
     * @param Game $game
     * @param string $username
     * @return string
     */
    public function findUserTokenByUsername(Game $game, string $username) :string {
        return $game->getUserA()->getUsername() === $username ? Game::USER_A_TOKEN : Game::USER_B_TOKEN;
    }

    /**
     * @param string $gameName
     * @return Game
     */
    public function getGame(string $gameName) :Game {
        $game = new Game();
        $game->setName($gameName);
        return $game;
    }
}