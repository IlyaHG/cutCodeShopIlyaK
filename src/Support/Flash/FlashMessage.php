<?php

declare(strict_types=1);

namespace Support\Flash;

final class FlashMessage
{
    public function __construct(protected string $message, protected string $class)
    {
    }

    public function message(): string
    {
        return $this->message;
    }

    public function class()
    {
        return $this->class;
    }
}
