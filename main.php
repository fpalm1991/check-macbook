<?php

use CLI\CheckMacBook\Command\CheckBluetoothSettings;
use CLI\CheckMacBook\Command\CheckFileVaultSettings;
use CLI\CheckMacBook\Command\CheckFirewallSettings;
use Symfony\Component\Console\Application;

require __DIR__ . '/vendor/autoload.php';

$application = new Application();

$application->addCommands([
    new CheckBluetoothSettings(),
    new CheckFileVaultSettings(),
    new CheckFirewallSettings(),
]);

$application->run();