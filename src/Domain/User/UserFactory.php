<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 21:50
 */

namespace App\Domain\User;



use App\Domain\User\Entity\User;

class UserFactory
{
    public function createUser(string $username) : User {
        return new User($username);
    }
}