<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:11
 */
namespace App\Domain\Game;

use App\Domain\Game\Entity\Game;
use App\Domain\User\UserService;

class GameBuilder implements GameBuilderInterface
{
    /**
     * @var Game
     */
    private $game;

    protected $userManager;

    /**
     * GameBuilder constructor.
     * @param UserService $userManager
     */
    public function __construct(UserService $userManager)
    {
        $this->game = new Game();
        $this->userManager = $userManager;
    }


    public function addPlayerA(string $username)
    {
        $playerA = $this->userManager->createUser($username);
        $this->game->addPlayerA($playerA);

        return $this;
    }

    public function addPlayerB(string $username)
    {
        $playerB = $this->userManager->createUser($username);
        $this->game->addPlayerB($playerB);

        return $this;
    }

    public function drawBoard(int $dimension)
    {
        $boardFactory = new BoardFactory();
        $board = $boardFactory->createEmptyBoard($dimension);
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