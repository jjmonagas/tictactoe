<?php

namespace App\Application\Command;

use App\Application\Command\Utils\GameNoWinnerBuilder;
use App\Application\Command\Utils\GamePlayerAWinnerBuilder;
use App\Application\Command\Utils\GamePlayerBWinnerBuilder;
use App\Domain\Game\Entity\BoardGame;
use App\Domain\Game\GameBuilder;
use App\Domain\Game\GameService;
use App\Domain\Game\MovementService;
use App\Domain\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoeCheckFinishedWinnerCommand extends Command
{
    protected static $defaultName = 'tictactoe:check:finished:winner';

    protected $movementManager;
    protected $userManager;
    protected $gameManager;
    protected $gameDefaultBuilder;
    protected $gameUserAWinnerBuilder;
    protected $gameUserBWinnerBuilder;
    protected $gameNoWinnerBuilder;

    /**
     * TictactoeCheckFinishedWinnerCommand constructor.
     * @param MovementService $movementManager
     * @param UserService $userManager
     * @param GameService $gameManager
     * @param GameBuilder $gameBuilder
     * @param GamePlayerAWinnerBuilder $gameUserAWinnerBuilder
     * @param GamePlayerBWinnerBuilder $gameUserBWinnerBuilder
     * @param GameNoWinnerBuilder $gameNoWinnerBuilder
     */
    public function __construct(MovementService $movementManager,
                                UserService $userManager,
                                GameService $gameManager,
                                GameBuilder $gameBuilder,
                                GamePlayerAWinnerBuilder $gameUserAWinnerBuilder,
                                GamePlayerBWinnerBuilder $gameUserBWinnerBuilder,
                                GameNoWinnerBuilder $gameNoWinnerBuilder)
    {
        $this->movementManager = $movementManager;
        $this->userManager = $userManager;
        $this->gameManager = $gameManager;

        $this->gameDefaultBuilder = $gameBuilder;
        $this->gameUserAWinnerBuilder = $gameUserAWinnerBuilder;
        $this->gameUserBWinnerBuilder = $gameUserBWinnerBuilder;
        $this->gameNoWinnerBuilder = $gameNoWinnerBuilder;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Check if the game is over and if there is a winner or not')
            ->addArgument('username-a', InputArgument::REQUIRED, 'Username A')
            ->addArgument('username-b', InputArgument::REQUIRED, 'Username B')
            ->addArgument('game-name', InputArgument::REQUIRED, 'Game name')
            ->addOption('winner', 'w', InputOption::VALUE_REQUIRED, 'Decide who is the winner A or B')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $usernameA = $input->getArgument('username-a');
        $usernameB = $input->getArgument('username-b');
        $gameName = $input->getArgument('game-name');
        $winner = $input->getOption('winner');

        $playerA = $this->userManager->getUser($usernameA);
        $playerB = $this->userManager->getUser($usernameB);

        $gameBuilder = $this->gameDefaultBuilder;
        if ($winner !== null) {
            $newGameBuilder = $winner === 'A' ? $this->gameUserAWinnerBuilder : null;
            $newGameBuilder = $newGameBuilder === null && $winner === 'B' ? $this->gameUserBWinnerBuilder : $newGameBuilder;
            $newGameBuilder = $newGameBuilder === null && $winner === '0' ? $this->gameNoWinnerBuilder : $newGameBuilder;
            $gameBuilder = $newGameBuilder ?? $gameBuilder;
        }
        $newGame = $this->gameManager->startNewGame($usernameA, $usernameB, $gameName, BoardGame::BOARD_DIMENSION_DEFAULT, $gameBuilder);

        $io->section('BOARD');
        var_dump($newGame->getBoardGame()->board);

        if ($this->movementManager->isPlayerWinner($newGame, $playerA)) {
            $io->success('Congratulations ' . $playerA->getUsername() . '! You are the winner!!');
        } else if ($this->movementManager->isPlayerWinner($newGame, $playerB)) {
            $io->success('Congratulations ' . $playerB->getUsername() . '! You are the winner!!');
        } else if (!$this->movementManager->hasFreeMovements($newGame)) {
            $io->warning('GAME OVER! No more movements left');
        } else {
            $io->note('Continue playing! Anyone can be the winner');
        }
    }
}
