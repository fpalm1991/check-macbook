<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Command;

use CLI\CheckMacBook\Service\SettingChecker;
use Override;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CheckFileVaultSettings extends Command
{
    private string $settingsName = 'FileVault';

    #[Override]
    protected function configure(): void
    {
        $this
            ->setName('check:filevault')
            ->setDescription('Check FileVault status of device')
            ->setHelp('This command checks the current FileVault status in settings.');
    }

    #[Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $state = new SettingChecker(
            command: 'fdesetup status',
            expectedCommandOutput: 'FileVault is On.')->checkStatus();

        $io = new SymfonyStyle($input, $output);
        $io->title($this->settingsName . ' ' . 'Status');
        $io->writeln("<fg={$state->color()}>{$state->readable()}</>");

        return Command::SUCCESS;
    }
}
