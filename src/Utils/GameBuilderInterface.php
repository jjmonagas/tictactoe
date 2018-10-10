<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:41
 */

namespace App\Utils;


interface GameBuilderInterface
{
    public function addUserA(string $username);

    public function addUserB(string $username);

    public function createBoard(int $dimension);

    public function setName(string $name);
}