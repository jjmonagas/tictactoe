<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:56
 */

namespace App\Domain\Game;



use App\Domain\Game\Entity\Game;


class GameService implements GameInterface
{
    /**
     * @param string $usernameA
     * @param string $usernameB
     * @param string $gameName
     * @param int $boardDimension
     * @param GameBuilderInterface $gameBuilder
     * @return mixed
     */
    public function startNewGame(string $usernameA, string $usernameB, string $gameName, int $boardDimension, GameBuilderInterface $gameBuilder) : Game
    {
        $gameBuilder->addPlayerA($usernameA);
        $gameBuilder->addPlayerB($usernameB);
        $gameBuilder->drawBoard($boardDimension);
        $gameBuilder->setName($gameName)
        ;
        return $gameBuilder->getGame();
    }

    /**
     * @param Game $game
     * @param string $username
     * @return string
     */
    public function findPlayerTokenByUsername(Game $game, string $username) :string {
        return $game->getPlayerA()->getUsername() === $username ? Game::PLAYER_A_TOKEN : Game::PLAYER_B_TOKEN;
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