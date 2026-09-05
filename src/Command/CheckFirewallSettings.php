<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Command;

use CLI\CheckMacBook\Service\SettingChecker;
use Override;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CheckFirewallSettings extends Command
{

    #[Override]
    protected function configure(): void
    {
        $this
            ->setName('check:firewall')
            ->setDescription('Check firewall status of device')
            ->setHelp('This command checks the current Firewall status in settings.');
    }

    #[Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $state = new SettingChecker(
            command: '/usr/libexec/ApplicationFirewall/socketfilterfw --getglobalstate',
            expectedCommandOutput: 'Firewall is enabled. (State = 1)')->checkStatus();

        $io = new SymfonyStyle($input, $output);
        $io->title('Firewall Status');
        $io->writeln("<fg={$state->color()}>{$state->readable()}</>");

        return Command::SUCCESS;
    }
}
