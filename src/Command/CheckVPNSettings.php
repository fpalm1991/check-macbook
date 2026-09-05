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

final class CheckVPNSettings extends Command
{

    #[Override]
    protected function configure(): void
    {
        $this
            ->setName('check:vpn')
            ->setDescription('Check VPN status of device')
            ->setHelp('This command checks the current VPN status of the device.');
    }

    #[Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $state = new SettingChecker(
            command: 'scutil --nc list',
            expectedCommandOutput: '* (Connected)',
            comparator: str_contains(...),
            onStatus: new Status('Connected', 'green'),
            offStatus: new Status('Disconnected', 'red'),
        )->checkStatus();

        $io = new SymfonyStyle($input, $output);
        $io->title('VPN Status');
        $io->writeln("<fg={$state->color()}>{$state->readable()}</>");

        return Command::SUCCESS;
    }
}
