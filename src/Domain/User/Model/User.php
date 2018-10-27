<?php
namespace App\Domain\User\Model;

use App\Domain\Game\Model\Player;

/**
 * Class User
 * @package App\Model
 */
class User implements Player
{
    /**
     * @var string
     */
    protected $username;


    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * User constructor.
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
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
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}