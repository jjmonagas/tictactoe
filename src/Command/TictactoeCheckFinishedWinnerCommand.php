<?php

namespace App\Command;

use App\Model\Game;
use App\Services\GameManager;
use App\Services\MovementsManager;
use App\Services\UserManager;
use App\Utils\BoardFactory;
use App\Utils\GameBuilder;
use App\Utils\GameNoWinnerBuilder;
use App\Utils\GameUserAWinnerBuilder;
use App\Utils\GameUserBWinnerBuilder;
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
     * @param MovementsManager $movementManager
     * @param UserManager $userManager
     * @param GameManager $gameManager
     * @param GameBuilder $gameBuilder
     * @param GameUserAWinnerBuilder $gameUserAWinnerBuilder
     * @param GameUserBWinnerBuilder $gameUserBWinnerBuilder
     * @param GameNoWinnerBuilder $gameNoWinnerBuilder
     */
    public function __construct(MovementsManager $movementManager,
                                UserManager $userManager,
                                GameManager $gameManager,
                                GameBuilder $gameBuilder,
                                GameUserAWinnerBuilder $gameUserAWinnerBuilder,
                                GameUserBWinnerBuilder $gameUserBWinnerBuilder,
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

        $userA = $this->userManager->getUser($usernameA);
        $userB = $this->userManager->getUser($usernameB);

        $gameBuilder = $this->gameDefaultBuilder;
        if ($winner !== null) {
            $newGameBuilder = $winner === 'A' ? $this->gameUserAWinnerBuilder : null;
            $newGameBuilder = $newGameBuilder === null && $winner === 'B' ? $this->gameUserBWinnerBuilder : $newGameBuilder;
            $newGameBuilder = $newGameBuilder === null && $winner === '0' ? $this->gameNoWinnerBuilder : $newGameBuilder;
            $gameBuilder = $newGameBuilder ?? $gameBuilder;
        }
        $newGame = $this->gameManager->createNewGame($usernameA, $usernameB, $gameName, Game::BOARD_DIMENSION_DEFAULT, $gameBuilder);

        $io->section('BOARD');
        var_dump($newGame->getBoard());

        if ($this->movementManager->isUserWinner($newGame, $userA)) {
            $io->success('Congratulations ' . $userA->getUsername() . '! You are the winner!!');
        } else if ($this->movementManager->isUserWinner($newGame, $userB)) {
            $io->success('Congratulations ' . $userB->getUsername() . '! You are the winner!!');
        } else if (!$this->movementManager->hasFreeMovements($newGame)) {
            $io->warning('GAME OVER! No more movements left');
        } else {
            $io->note('Continue playing! Anyone can be the winner');
        }
    }
}
