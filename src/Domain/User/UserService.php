<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:01
 */
namespace App\Domain\User;


use App\Domain\User\Entity\User;

class UserService implements UserInterface
{

    /**
     * @param string $username
     * @return User
     */
    public function createUser(string $username) :User {
        $userFactory = new UserFactory();
        return $userFactory->createUser($username);
    }

    /**
     * @param string $username
     * @return string
     */
    public function deleteUser(string $username) :string {
        //Find user by username
        //remove user
        //DISPATCH EVENT to remove GAMES
        //return message
        return 'User ' . $username . ' deleted';
    }

    /**
     * @param string $username
     * @return User
     */
    public function getUser(string $username) :User {
        return new User($username);
    }

}