<?php
namespace App\Domain\Game;

use App\Domain\Game\Factory\GameBuilder;
use App\Domain\Game\Model\Game;
use App\Domain\Game\Model\GameBoard;
use App\Domain\Game\Model\Player;


class GameService
{

    protected $gameBuilder;

    /**
     * GameService constructor.
     * @param GameBuilder $gameBuilder
     */
    public function __construct(GameBuilder $gameBuilder)
    {
        $this->gameBuilder = $gameBuilder;
    }


    /**
     * @param Player $playerA
     * @param Player $playerB
     * @param string $gameName
     * @param GameBoard $gameBoard
     * @return Game
     */
    public function startNewGame(Player $playerA, Player $playerB, string $gameName, GameBoard $gameBoard) : Game
    {
        $this->gameBuilder->addPlayerA($playerA);
        $this->gameBuilder->addPlayerB($playerB);
        $this->gameBuilder->drawBoard($gameBoard);
        $this->gameBuilder->setGameName($gameName);
        return $this->gameBuilder->getGame();
    }

    /**
     * @param Game $game
     * @param string $username
     * @return string
     */
    public function findPlayerTokenByUsername(Game $game, string $username) :string {
        return $game->getPlayerA()->getUsername() === $username ? $game->getPlayerAToken() : $game->getPlayerBToken();
    }

    /**
     * @param string $gameName
     * @return Game
     */
    public function findGameByName(string $gameName) :Game {
        $game = new Game();
        $game->setName($gameName);
        return $game;
    }
}