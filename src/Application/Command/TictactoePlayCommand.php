<?php

namespace App\Application\Command;


use App\Domain\Game\Factory\GameBoardFactory;
use App\Domain\Game\GameBoardPrinter;
use App\Domain\Game\Model\PlayerToken;

use App\Domain\Game\GameService;
use App\Domain\User\Factory\UserFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoePlayCommand extends Command
{
    protected static $defaultName = 'tictactoe:play:start';

    protected $gameManager;
    protected $gameBoardPrinter;

    /**
     * TictactoePlayCommand constructor.
     * @param GameService $gameManager
     * @param GameBoardPrinter $gameBoardPrinter
     */
    public function __construct(GameService $gameManager, GameBoardPrinter $gameBoardPrinter)
    {
        $this->gameManager = $gameManager;
        $this->gameBoardPrinter = $gameBoardPrinter;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Create a TIC TAC TOE game')
            ->addArgument('usernameA', InputArgument::REQUIRED, 'Username for Player A')
            ->addArgument('usernameB', InputArgument::REQUIRED, 'Username for Player B')
            ->addArgument('game-name', InputArgument::REQUIRED, 'Game name')
            ->addOption('dimension', 'd', InputOption::VALUE_REQUIRED, 'Board game dimension. Default 3', 3)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $usernameA = $input->getArgument('usernameA');
        $usernameB = $input->getArgument('usernameB');
        $gameName = $input->getArgument('game-name');
        $dimension = $input->getOption('dimension');

        if ($dimension < 3) {
            $io->warning('Impossible to create a game with that dimension. Minimum board is with dimension 3');
        } else {

            $userFactory = new UserFactory();
            $playerA = $userFactory->createUser($usernameA);
            $playerB = $userFactory->createUser($usernameB);

            $gameBoardFactory = new GameBoardFactory();
            $gameBoard = $gameBoardFactory->createEmptyBoard($dimension);

            $newGame = $this->gameManager->startNewGame($playerA, $playerB, $gameName, $gameBoard);

            $io->success('A new game ' . $newGame->getName() . ' created! Let\'s play!');
            $io->section('Some instructions');
            $io->note('Player token for ' . $newGame->getPlayerA()->getUsername() . ' is ' . PlayerToken::PLAYER_TOKEN_X);
            $io->note('Player token for ' . $newGame->getPlayerB()->getUsername() . ' is ' . PlayerToken::PLAYER_TOKEN_O);

            $io->section('Game Board');
            $this->gameBoardPrinter->printBoard($newGame->getGameBoard());
        }


    }
}
