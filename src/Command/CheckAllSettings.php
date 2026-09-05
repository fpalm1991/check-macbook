<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Command;

use Override;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CheckAllSettings extends Command
{

    private const array COMMANDS = [
        'check:bluetooth',
        'check:vpn',
        'check:firewall',
        'check:filevault',
    ];

    #[Override]
    protected function configure(): void
    {
        $this
            ->setName('check:all')
            ->setDescription('Check all settings of device')
            ->setHelp('This command checks all settings of device.');
    }

    #[Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $application = $this->getApplication();
        $io = new SymfonyStyle($input, $output);

        foreach (self::COMMANDS as $name) {
            $command = $application->find($name);

            try {
                $command->run($input, $output);
            } catch (ProcessFailedException $e) {
                $io->error("Process failed: " . $e->getMessage());
                return Command::FAILURE;
            } catch (ExceptionInterface $e) {
                $io->error("Exception: " . $e->getMessage());
                return Command::FAILURE;
            }
        }

        return command::SUCCESS;
    }
}
