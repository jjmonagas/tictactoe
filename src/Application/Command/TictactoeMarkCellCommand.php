<?php

namespace App\Application\Command;

use App\Domain\Game\Factory\GameBoardFactory;
use App\Domain\Game\GameBoardPrinter;
use App\Domain\Game\GameService;
use App\Domain\User\Factory\UserFactory;
use App\Domain\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoeMarkCellCommand extends Command
{
    protected static $defaultName = 'tictactoe:mark:cell';

    protected $movementManager;
    protected $userService;
    protected $gameService;
    protected $gameBoardPrinter;


    public function __construct(UserService $userService, GameService $gameService, GameBoardPrinter $gameBoardPrinter)
    {
        $this->userService = $userService;
        $this->gameService = $gameService;
        $this->gameBoardPrinter = $gameBoardPrinter;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
            ->addArgument('game-name', InputArgument::REQUIRED, 'Game name')
            ->addArgument('coordinate-x', InputArgument::REQUIRED, 'Coordinate X')
            ->addArgument('coordinate-y', InputArgument::REQUIRED, 'Coordinate Y')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $gameName = $input->getArgument('game-name');
        $coordinateX = $input->getArgument('coordinate-x');
        $coordinateY = $input->getArgument('coordinate-y');

        $playerA = $this->userService->findUserByUsername($username);
        $userFactory = new UserFactory();
        $playerB = $userFactory->createUser('machine');

        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard();

        $newGame = $this->gameService->startNewGame($playerA, $playerB, $gameName, $gameBoard);

        $playerToken = $this->gameService->findPlayerTokenByUsername($newGame, $username);

        $newGame->markCellWithAPlayerToken($coordinateX, $coordinateY, $playerToken);

        $io->section('Game Board');
        $this->gameBoardPrinter->printBoard($newGame->getGameBoard());

        $io->success('User ' . $username . ' has marked GameBoard[' . $coordinateX . '][' . $coordinateY . ']');
    }
}