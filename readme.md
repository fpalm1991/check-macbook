# Check MacBook Settings

A small command-line tool built with PHP and Symfony Console for checking the status of macOS security settings like
FileVault, Firewall, Bluetooth, and VPN connections.

## Requirements

- PHP 8.5
- Composer
- macOS

## Usage

Run an individual check:
`php main.php check:filevault`

Run every check at once:
`php main.php check:all`

## Available commands

- check:all
- check:bluetooth
- check:filevault
- check:firewall
- check:vpn
