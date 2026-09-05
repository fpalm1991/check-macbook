<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Service;

use CLI\CheckMacBook\Enum\SettingStatus;
use CLI\CheckMacBook\Interface\Displayable;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

final readonly class SettingChecker
{

    public function __construct(
        private string      $command,
        private string      $expectedCommandOutput,
        private ?\Closure   $comparator = null,
        private Displayable $onStatus = SettingStatus::ON,
        private Displayable $offStatus = SettingStatus::OFF,
    )
    {
    }

    public function checkStatus(): Displayable
    {

        $state = $this->getState();
        $comparator = $this->comparator ?? static fn(string $a, string $b): bool => ($a === $b);

        return $comparator($state, $this->expectedCommandOutput)
            ? $this->onStatus
            : $this->offStatus;
    }

    private function getState(): string
    {

        $process = Process::fromShellCommandline($this->command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return trim($process->getOutput());
    }
}
