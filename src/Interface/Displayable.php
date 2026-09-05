<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Interface;

interface Displayable
{
    public function readable(): string;

    public function color(): string;
}
