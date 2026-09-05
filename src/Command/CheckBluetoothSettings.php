<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Command;

use CLI\CheckMacBook\Service\SettingChecker;
use CLI\CheckMacBook\Service\Status;
use Override;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CheckBluetoothSettings extends Command
{

    #[Override]
    protected function configure(): void
    {

        $this
            ->setName('check:bluetooth')
            ->setDescription('Check Bluetooth status of device')
            ->setHelp('This command checks the current Bluetooth status in settings.');
    }

    #[Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $state = new SettingChecker(
            command: 'system_profiler SPBluetoothDataType | grep -i "state" | xargs',
            expectedCommandOutput: 'State: On',
            onStatus: new Status('On', 'red'),
            offStatus: new Status('Off', 'green'),
        )->checkStatus();

        $io = new SymfonyStyle($input, $output);
        $io->title('Bluetooth Settings');
        $io->writeln("<fg={$state->color()}>{$state->readable()}</>");

        return Command::SUCCESS;
    }
}
