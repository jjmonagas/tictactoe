<?php

namespace App\Command;

use App\Model\Game;
use App\Services\GameManager;
use App\Services\MovementsManager;
use App\Services\UserManager;
use App\Utils\GameBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoeMovementCommand extends Command
{
    protected static $defaultName = 'tictactoe:movement';

    protected $movementManager;
    protected $userManager;
    protected $gameManager;
    protected $gameBuilder;

    /**
     * TictactoeMovementCommand constructor.
     * @param MovementsManager $movementManager
     * @param UserManager $userManager
     * @param GameManager $gameManager
     */
    public function __construct(MovementsManager $movementManager, UserManager $userManager, GameManager $gameManager, GameBuilder $gameBuilder)
    {
        $this->movementManager = $movementManager;
        $this->userManager = $userManager;
        $this->gameManager = $gameManager;
        $this->gameBuilder = $gameBuilder;

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

        $user = $this->userManager->getUser($username);
        $newGame = $this->gameManager->createNewGame($username, 'machine', $gameName, Game::BOARD_DIMENSION_DEFAULT, $this->gameBuilder);

        $newMovement = $this->movementManager->makeMovement($user, $newGame, $coordinateX, $coordinateY);

        $io->section('Board');
        var_dump($newMovement->getGame()->getBoard());

        $io->success('User ' . $newMovement->getUser()->getUsername() . ' has marked board[' . $newMovement->getCoordinateX() . '][' . $newMovement->getCoordinateY() . ']');
    }
}
