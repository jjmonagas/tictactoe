<?php

namespace App\Application\Command;


use App\Domain\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class TictactoeDeleteUserCommand extends Command
{
    protected static $defaultName = 'tictactoe:delete-user';

    protected $userService;

    /**
     * TictactoeDeleteUserCommand constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

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

        $user = $this->userService->findUserByUsername($username);
        $response = $this->userService->deleteUser($user);

        $io->success($response);
    }
}
