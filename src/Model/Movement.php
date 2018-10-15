<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:07
 */

namespace App\Model;


class Movement
{
    public const EMPTY_MOVEMENT = '';

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Game
     */
    protected $game;

    /**
     * @var int
     */
    protected $coordinateX;

    /**
     * @var int
     */
    protected $coordinateY;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Movement
     */
    public function setUser(User $user): Movement
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * @param Game $game
     * @return Movement
     */
    public function setGame(Game $game): Movement
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoordinateX(): int
    {
        return $this->coordinateX;
    }

    /**
     * @param int $coordinateX
     * @return Movement
     */
    public function setCoordinateX(int $coordinateX): Movement
    {
        $this->coordinateX = $coordinateX;
        return $this;
    }

    /**
     * @return int
     */
    public function getCoordinateY(): int
    {
        return $this->coordinateY;
    }

    /**
     * @param int $coordinateY
     * @return Movement
     */
    public function setCoordinateY(int $coordinateY): Movement
    {
        $this->coordinateY = $coordinateY;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Movement
     */
    public function setCreatedAt(\DateTime $createdAt): Movement
    {
        $this->createdAt = $createdAt;
        return $this;
    }

}