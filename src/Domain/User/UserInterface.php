<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 10/10/18
 * Time: 1:37
 */

namespace App\Domain\User;



use App\Domain\User\Entity\User;

interface UserInterface
{
    public function createUser(string $username) :User;
    public function deleteUser(string $username) :string;
    public function getUser(string $username) :User;
}