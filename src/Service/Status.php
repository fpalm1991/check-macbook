<?php

declare(strict_types=1);

namespace CLI\CheckMacBook\Service;

use CLI\CheckMacBook\Interface\Displayable;

final readonly class Status implements Displayable
{

    public function __construct(
        private string $readable,
        private string $color,
    )
    {
    }

    public function readable(): string
    {
        return $this->readable;
    }

    public function color(): string
    {
        return $this->color;
    }
}
