<?php
namespace App\Domain\User\Factory;

use App\Domain\User\Model\User;

class UserFactory
{
    public function createUser(string $username) : User {
        return new User($username);
    }
}