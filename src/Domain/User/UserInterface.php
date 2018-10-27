<?php
namespace App\Domain\User;

use App\Domain\User\Model\User;

interface UserInterface
{
    public function createUser(string $username) :User;
    public function deleteUser(User $user) :string;
    public function findUserByUsername(string $username) :User;
}