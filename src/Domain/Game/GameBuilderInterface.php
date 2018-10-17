<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:41
 */

namespace App\Domain\Game;


use App\Domain\Game\Entity\Game;

interface GameBuilderInterface
{
    public function addPlayerA(string $username);

    public function addPlayerB(string $username);

    public function drawBoard(int $dimension);

    public function setName(string $name);

    public function getGame() : Game;
}