<?php

namespace Nsign\Auth\Domain\User\ValueObject;

/**
 * ProductName
 */
final class ProductName
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name;
    }
}