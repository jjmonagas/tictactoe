<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:11
 */

namespace App\Utils;


use App\Model\Game;
use App\Services\UserManager;

class GameBuilder implements GameBuilderInterface
{
    /**
     * @var Game
     */
    private $game;

    protected $userManager;

    /**
     * GameBuilder constructor.
     * @param $game
     */
    public function __construct(UserManager $userManager)
    {
        $this->game = new Game();
        $this->userManager = $userManager;
    }


    public function addUserA(string $username)
    {
        //create if not exists
        $userA = $this->userManager->createUser($username);
        $this->game->setUserA($userA);

        return $this;
    }

    public function addUserB(string $username)
    {
        $userB = $this->userManager->createUser($username);
        $this->game->setUserB($userB);

        return $this;
    }

    public function createBoard(int $dimension)
    {
        $boardFactory = new BoardFactory();
        $board = $boardFactory->createBoard($dimension);
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