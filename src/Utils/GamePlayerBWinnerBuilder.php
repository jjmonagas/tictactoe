<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:11
 */

namespace App\Utils;



use App\Domain\Game\Entity\Game;
use App\Domain\User\UserService;

class GamePlayerBWinnerBuilder implements GameBuilderInterface
{
    /**
     * @var Game
     */
    private $game;

    protected $userManager;

    /**
     * GameUserAWinnerBuilder constructor.
     * @param UserService $userManager
     */
    public function __construct(UserService $userManager)
    {
        $this->game = new Game();
        $this->userManager = $userManager;
    }


    public function addPlayerA(string $username)
    {
        //create if not exists
        $playerA = $this->userManager->createUser($username);
        $this->game->setPlayerA($playerA);

        return $this;
    }

    public function addPlayerB(string $username)
    {
        $playerB = $this->userManager->createUser($username);
        $this->game->setPlayerB($playerB);

        return $this;
    }

    public function drawBoard(int $dimension)
    {
        $boardFactory = new BoardFactory();
        $board = $boardFactory->createBoardWithToken($dimension, Game::USER_B_TOKEN);
        $this->game->setBoard($board);
        $this->game->setBoardDimension($dimension);

        return $this;
    }

    public function setName(string $name)
    {
        $this->game->setName($name);

        return $this;
    }


    public function getGame() : Game {
        return $this->game;
    }

}