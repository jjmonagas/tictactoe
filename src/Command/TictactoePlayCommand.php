<?php

namespace App\Command;

use App\Model\Game;
use App\Services\GameManager;
use App\Utils\GameBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoePlayCommand extends Command
{
    protected static $defaultName = 'tictactoe:play';

    protected $gameManager;
    protected $gameBuilder;

    /**
     * TictactoePlayCommand constructor.
     * @param GameManager $gameManager
     */
    public function __construct(GameManager $gameManager, GameBuilder $gameBuilder)
    {
        $this->gameManager = $gameManager;
        $this->gameBuilder = $gameBuilder;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Create a TIC TAC TOE game')
            ->addArgument('usernameA', InputArgument::REQUIRED, 'Username for User A')
            ->addArgument('usernameB', InputArgument::REQUIRED, 'Username for User B')
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
            $io->warning('Imposible to create a game with that dimension. Minimum board is with dimension 3');
        } else {

            $newGame = $this->gameManager->createNewGame($usernameA, $usernameB, $gameName, $dimension, $this->gameBuilder);

            $io->success('A new game ' . $newGame->getName() . ' created! Let\'s play!');
            $io->section('Some instructions');
            $io->note('User token for ' . $newGame->getUserA()->getUsername() . ' is ' . Game::USER_A_TOKEN);
            $io->note('User token for ' . $newGame->getUserB()->getUsername() . ' is ' . Game::USER_B_TOKEN);
        }


    }
}
