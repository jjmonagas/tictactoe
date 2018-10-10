<?php

namespace App\Command;

use App\Services\UserManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoeCreateUserCommand extends Command
{
    protected static $defaultName = 'tictactoe:create-user';

    protected $userManager;

    /**
     * TictactoeCreateUserCommand constructor.
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;

        parent::__construct();
    }


    protected function configure()
    {
        $this
            ->setDescription('Create a new User')
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');

        $newUser = $this->userManager->createUser($username);

        $io->success('New User ' . $newUser->getUsername() . ' created!');
    }
}
