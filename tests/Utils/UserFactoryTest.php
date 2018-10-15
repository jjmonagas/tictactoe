<?php

namespace App\Tests\Utils;

use App\Utils\UserFactory;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{

    /**
     * @dataProvider usernamesProvider
     */
    public function testUserCreateByUsername(string $username)
    {
        $userFactory = new UserFactory();
        $user = $userFactory->createUser($username);
        $this->assertEquals($username, $user->getUsername());
    }

    public function usernamesProvider() {
        return [
            ['John Doe'],
            ['Mary Lou'],
            ['Mike White']
            ];
    }
}
