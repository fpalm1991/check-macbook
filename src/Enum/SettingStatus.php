<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Enum;

use CLI\CheckMacBook\Interface\Displayable;

enum SettingStatus: int implements Displayable
{

    case OFF = 0;
    case ON = 1;

    public function readable(): string
    {
        return match ($this) {
            self::OFF => 'Off',
            self::ON => 'On',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::OFF => 'red',
            self::ON => 'green',
        };
    }
}
