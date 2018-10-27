<?php
namespace App\Domain\Game\Model;


class PlayerToken
{
    public const PLAYER_TOKEN_X = 'X';
    public const PLAYER_TOKEN_O = 'O';

    public const PLAYER_TOKEN_EXTRA = '-';

    public function getPalyerToken_X() {
        return self::PLAYER_TOKEN_X;
    }

    public function getPalyerToken_O() {
        return self::PLAYER_TOKEN_O;
    }

    public function getPalyerToken_Extra() {
        return self::PLAYER_TOKEN_EXTRA;
    }
}