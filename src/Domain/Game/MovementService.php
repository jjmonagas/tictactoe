<?php
/**
 * Created by PhpStorm.
 * User: jjmonagas
 * Date: 9/10/18
 * Time: 22:11
 */
namespace App\Domain\Game;


use App\Domain\Game\Entity\Game;
use App\Domain\Game\Entity\Movement;
use App\Domain\Game\Entity\Player;


class MovementService implements MovementInterface
{

    protected $gameManager;

    /**
     * MovementsManager constructor.
     * @param $gameManager
     */
    public function __construct(GameService $gameManager)
    {
        $this->gameManager = $gameManager;
    }


    /**
     * @param Player $player
     * @param Game $game
     * @param int $coordinateX
     * @param int $coordinateY
     * @return Movement
     */
    public function makeMovement(Player $player, Game $game, int $coordinateX, int $coordinateY) :Movement {
        $movement = null;
        $board = $game->getBoard();
        if ($board[$coordinateX][$coordinateY] === Movement::EMPTY_MOVEMENT) {
            $userToken = $this->gameManager->findPlayerTokenByUsername($game, $player->getUsername());
            $board[$coordinateX][$coordinateY] = $userToken;
            //TODO save Game
            $game->setBoard($board);

            //TODO Save movement as LOGS
            $movement = new Movement();
            $movement->setGame($game)
                ->setPlayer($player)
                ->setCoordinateX($coordinateX)
                ->setCoordinateY($coordinateY);
        }
        return $movement;
    }

    /**
     * @param Game $game
     * @param Player $player
     * @return bool
     */
    public function isPlayerWinner(Game $game, Player $player) :bool {
        return $this->winnerDiagonalMovements($game, $player) ||
            $this->winnerHorizontalMovements($game, $player) ||
            $this->winnerVerticalMovements($game, $player);
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
     * @param Player $player
     * @return bool
     */
    private function winnerHorizontalMovements(Game $game, Player $player) :bool {
        $playerHits = 0;
        $playerToken = $this->gameManager->findPlayerTokenByUsername($game, $player->getUsername());
        $boardDimension = $game->getBoardDimension();
        $board = $game->getBoard();
        for ($n = 0; $n < $boardDimension; $n++) {
            for($m = 0; $m < $boardDimension; $m++) {
                if ($board[$n][$m] === $playerToken) {
                    $playerHits++;
                }
            }
        }
        return $this->checkWinnerRow($playerHits, $game);
    }

    /**
     * @param Game $game
     * @param Player $player
     * @return bool
     */
    private function winnerVerticalMovements(Game $game, Player $player) :bool {
        $playerHits = 0;
        $playerToken = $this->gameManager->findPlayerTokenByUsername($game, $player->getUsername());
        $boardDimension = $game->getBoardDimension();
        $board = $game->getBoard();
        for ($n = 0; $n < $boardDimension; $n++) {
            for($m = 0; $m < $boardDimension; $m++) {
                if ($board[$m][$n] === $playerToken) {
                    $playerHits++;
                }
            }
        }
        return $this->checkWinnerRow($playerHits, $game);
    }

    /**
     * @param Game $game
     * @param Player $player
     * @return bool
     */
    private function winnerDiagonalMovements(Game $game, Player $player) :bool {
        $playerHitsFirstDiagonal = 0;
        $playerHitsSecondDiagonal = 0;
        $playerToken = $this->gameManager->findPlayerTokenByUsername($game, $player->getUsername());
        $boardDimension = $game->getBoardDimension();
        $board = $game->getBoard();
        for ($n = 0; $n < $boardDimension; $n++) {
            if ($board[$n][$n] === $playerToken) {
                $playerHitsFirstDiagonal++;
            }
            $mSecondDiagonal = ($boardDimension - 1) - $n;
            if ($board[$n][$mSecondDiagonal] === $playerToken) {
                $playerHitsSecondDiagonal++;
            }
        }

        return $this->checkWinnerRow($playerHitsFirstDiagonal, $game) || $this->checkWinnerRow($playerHitsSecondDiagonal, $game);
    }


    /**
     * @param int $playerHits
     * @param Game $game
     * @return bool
     */
    private function checkWinnerRow(int $playerHits, Game $game) :bool {
        return $playerHits === $game->getBoardDimension();
    }

}