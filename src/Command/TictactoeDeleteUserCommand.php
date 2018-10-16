<?php

namespace App\Command;


use App\Domain\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoeDeleteUserCommand extends Command
{
    protected static $defaultName = 'tictactoe:delete-user';

    protected $userManager;

    /**
     * TictactoeCreateUserCommand constructor.
     * @param UserService $userManager
     */
    public function __construct(UserService $userManager)
    {
        $this->userManager = $userManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Delete a user')
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');

        $response = $this->userManager->deleteUser($username);

        $io->success($response);
    }
}
