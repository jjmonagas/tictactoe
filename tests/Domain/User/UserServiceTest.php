<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 27/10/18
 * Time: 12:59
 */

namespace Domain\User;


use App\Domain\User\Model\User;
use App\Domain\User\UserService;
use App\Infrastructure\Game\GameRepository;
use App\Infrastructure\User\UserRepository;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    
    public function testCreateUser() {
        $userRepository = new UserRepository();
        $gameRepository = new GameRepository();
        
        $userService = new UserService($userRepository, $gameRepository);
        
        $user = $userService->createUser('charly');
        
        self::assertInstanceOf(User::class, $user);
        self::assertEquals('charly', $user->getUsername());
    }

    public function testFindUserByUserName() {
        $userRepository = new UserRepository();
        $gameRepository = new GameRepository();

        $userService = new UserService($userRepository, $gameRepository);

        $user = $userService->findUserByUsername('mark');

        self::assertInstanceOf(User::class, $user);
        self::assertEquals('mark', $user->getUsername());
    }

    public function testDeleteUser() {
        $userRepository = new UserRepository();
        $gameRepository = new GameRepository();

        $userService = new UserService($userRepository, $gameRepository);

        $user = new User('peter');

        self::assertEquals('User ' . $user->getUsername() . ' deleted', $userService->deleteUser($user));
    }

}