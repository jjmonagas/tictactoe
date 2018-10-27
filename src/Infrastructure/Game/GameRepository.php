<?php
namespace App\Infrastructure\Game;

use App\Domain\User\Model\User;

class GameRepository
{

    public function removeAllGamesByUser(User $user) {
        return 'All games removed to ' . $user->getUsername();
    }

}