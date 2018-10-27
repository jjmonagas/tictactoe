<?php

namespace App\Application\Command;


use App\Domain\Game\Factory\GameBoardFactory;
use App\Domain\Game\GameBoardService;
use App\Domain\Game\GameBoardPrinter;
use App\Domain\Game\GameService;
use App\Domain\Game\Model\PlayerToken;
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

    protected $userService;
    protected $gameService;
    protected $gameBoardPrinter;
    protected $gameBoardService;

    /**
     * TictactoeCheckFinishedWinnerCommand constructor.
     * @param UserService $userService
     * @param GameService $gameService
     * @param GameBoardPrinter $gameBoardPrinter
     * @param GameBoardService $gameBoardService
     */
    public function __construct(UserService $userService,
                                GameService $gameService,
                                GameBoardPrinter $gameBoardPrinter,
                                GameBoardService $gameBoardService
    )
    {
        $this->userService = $userService;
        $this->gameService = $gameService;
        $this->gameBoardPrinter = $gameBoardPrinter;
        $this->gameBoardService = $gameBoardService;

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

        $playerA = $this->userService->findUserByUsername($usernameA);
        $playerB = $this->userService->findUserByUsername($usernameB);

        $gameBoardFactory = new GameBoardFactory();
        $gameBoard = $gameBoardFactory->createEmptyBoard();

        $newGame = $this->gameService->startNewGame($playerA, $playerB, $gameName, $gameBoard);

        if ($winner !== null) {
            $winnerPlayerToken = $winner === 'A' ? PlayerToken::PLAYER_TOKEN_X : PlayerToken::PLAYER_TOKEN_EXTRA;
            $winnerPlayerToken = $winner === 'B' ? PlayerToken::PLAYER_TOKEN_O : $winnerPlayerToken;
            $this->gameBoardService->markAllCellsWithPlayerToken($newGame->getGameBoard(), $winnerPlayerToken);
        }

        $io->section('Game Board');

        $this->gameBoardPrinter->printBoard($newGame->getGameBoard());

        if ($newGame->checkIfThereIsAWinner($newGame->getPlayerAToken())) {
            $io->success('Congratulations ' . $playerA->getUsername() . '! You are the winner!!');
        } else if ($newGame->checkIfThereIsAWinner($newGame->getPlayerBToken())) {
            $io->success('Congratulations ' . $playerB->getUsername() . '! You are the winner!!');
        } else if (!$newGame->hasFreeMovements()) {
            $io->warning('GAME OVER! No more movements left');
        } else {
            $io->note('Continue playing! Anyone can be the winner');
        }
    }
}
