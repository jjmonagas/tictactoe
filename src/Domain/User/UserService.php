<?php
namespace App\Domain\User;


use App\Domain\User\Factory\UserFactory;
use App\Domain\User\Model\User;
use App\Infrastructure\Game\GameRepository;
use App\Infrastructure\User\UserRepository;

class UserService implements UserInterface
{

    protected $userRepository;
    protected $gameRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param GameRepository $gameRepository
     */
    public function __construct(UserRepository $userRepository, GameRepository $gameRepository)
    {
        $this->userRepository = $userRepository;
        $this->gameRepository = $gameRepository;
    }


    /**
     * @param string $username
     * @return User
     */
    public function createUser(string $username) :User {
        $userFactory = new UserFactory();
        return $userFactory->createUser($username);
    }

    /**
     * @param User $user
     * @return string
     */
    public function deleteUser(User $user) :string {
        $this->gameRepository->removeAllGamesByUser($user);
        $this->userRepository->removeUser($user);
        //DISPATCH EVENT USER_DELETE_EVENT
        return 'User ' . $user->getUsername() . ' deleted';
    }

    /**
     * @param string $username
     * @return User
     */
    public function findUserByUsername(string $username) :User {
        return $this->userRepository->findUserByUsername($username);
    }


}