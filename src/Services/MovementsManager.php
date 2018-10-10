<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:11
 */
namespace App\Services;

use App\Model\Game;
use App\Model\Movement;
use App\Model\User;

class MovementsManager implements MovementInterface
{

    protected $gameManager;

    /**
     * MovementsManager constructor.
     * @param $gameManager
     */
    public function __construct(GameManager $gameManager)
    {
        $this->gameManager = $gameManager;
    }


    /**
     * @param User $user
     * @param Game $game
     * @param int $coordinateX
     * @param int $coordinateY
     * @return Movement
     */
    public function makeMovement(User $user, Game $game, int $coordinateX, int $coordinateY) :Movement {
        $movement = null;
        $board = $game->getBoard();
        if ($board[$coordinateX][$coordinateY] === Movement::EMPTY_MOVEMENT) {
            $userToken = $this->gameManager->findUserTokenByUsername($game, $user->getUsername());
            $board[$coordinateX][$coordinateY] = $userToken;
            //TODO save Game
            $game->setBoard($board);

            //TODO Save movement as LOGS
            $movement = new Movement();
            $movement->setGame($game)
                ->setUser($user)
                ->setCoordinateX($coordinateX)
                ->setCoordinateY($coordinateY);
        }
        return $movement;
    }

    /**
     * @param Game $game
     * @param User $user
     * @return bool
     */
    public function isUserWinner(Game $game, User $user) :bool {
        return $this->winnerDiagonalMovements($game, $user) ||
            $this->winnerHorizontalMovements($game, $user) ||
            $this->winnerVerticalMovements($game, $user);
    }

    /**
     * @param Game $game
     * @return bool|int
     */
    public function hasFreeMovements(Game $game) :bool {
        $boardDimension = $game->getBoardDimension();
        $board = $game->getBoard();
        $freeMovements = 0;
        for ($n=0; $n < $boardDimension;$n++) {
            for($m=0; $m < $boardDimension; $m++) {
                if ($board[$n][$m] === '') {
                    $freeMovements = true;
                    break;
                }
            }
            if ($freeMovements) break;
        }
        return $freeMovements;
    }

    /**
     * @param Game $game
     * @param User $user
     * @return bool
     */
    private function winnerHorizontalMovements(Game $game, User $user) :bool {
        $userHits = 0;
        $userToken = $this->gameManager->findUserTokenByUsername($game, $user->getUsername());
        $boardDimension = $game->getBoardDimension();
        $board = $game->getBoard();
        for ($n = 0; $n < $boardDimension; $n++) {
            for($m = 0; $m < $boardDimension; $m++) {
                if ($board[$n][$m] === $userToken) {
                    $userHits++;
                }
            }
        }
        return $this->checkWinnerRow($userHits, $game);
    }

    /**
     * @param Game $game
     * @param User $user
     * @return bool
     */
    private function winnerVerticalMovements(Game $game, User $user) :bool {
        $userHits = 0;
        $userToken = $this->gameManager->findUserTokenByUsername($game, $user->getUsername());
        $boardDimension = $game->getBoardDimension();
        $board = $game->getBoard();
        for ($n = 0; $n < $boardDimension; $n++) {
            for($m = 0; $m < $boardDimension; $m++) {
                if ($board[$m][$n] === $userToken) {
                    $userHits++;
                }
            }
        }
        return $this->checkWinnerRow($userHits, $game);
    }

    /**
     * @param Game $game
     * @param User $user
     * @return bool
     */
    private function winnerDiagonalMovements(Game $game, User $user) :bool {
        $userHitsFirstDiagonal = 0;
        $userHitsSecondDiagonal = 0;
        $userToken = $this->gameManager->findUserTokenByUsername($game, $user->getUsername());
        $boardDimension = $game->getBoardDimension();
        $board = $game->getBoard();
        for ($n = 0; $n < $boardDimension; $n++) {
            if ($board[$n][$n] === $userToken) {
                $userHitsFirstDiagonal++;
            }
            $mSecondDiagonal = ($boardDimension - 1) - $n;
            if ($board[$n][$mSecondDiagonal] === $userToken) {
                $userHitsSecondDiagonal++;
            }
        }

        return $this->checkWinnerRow($userHitsFirstDiagonal, $game) || $this->checkWinnerRow($userHitsSecondDiagonal, $game);
    }


    /**
     * @param int $userHits
     * @param Game $game
     * @return bool
     */
    private function checkWinnerRow(int $userHits, Game $game) :bool {
        return $userHits === $game->getBoardDimension();
    }

}