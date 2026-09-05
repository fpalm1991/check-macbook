<?php

use CLI\CheckMacBook\Command\CheckBluetoothSettings;
use Symfony\Component\Console\Application;

require __DIR__ . '/vendor/autoload.php';

$application = new Application();

$application->addCommands([
    new CheckBluetoothSettings(),
]);

$application->run();