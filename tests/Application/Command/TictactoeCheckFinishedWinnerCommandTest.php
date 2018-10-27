<?php

namespace App\Tests\Application\Command;


use App\Application\Command\TictactoeCheckFinishedWinnerCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;


class TictactoeCheckFinishedWinnerCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);
        // returns the real and unchanged service container
        $container = self::$kernel->getContainer();
        // gets the special container that allows fetching private services
        $container = self::$container;


        $application->add(new TictactoeCheckFinishedWinnerCommand(
            $container->get('App\Domain\User\UserService'),
            $container->get('App\Domain\Game\GameService'),
            $container->get('App\Domain\Game\GameBoardPrinter'),
            $container->get('App\Domain\Game\GameBoardService')
            ));
        $command = $application->find('tictactoe:check:finished:winner');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
            'username-a' => 'Charles',
            'username-b' => 'Mary',
            'game-name' => 'My Tic tac Board',
            '--winner' => 'A',
            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
        ));
        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Congratulations Charles', $output);
    }
}
