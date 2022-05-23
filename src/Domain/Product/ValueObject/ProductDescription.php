<?php

namespace Nsign\Auth\Domain\User\ValueObject;

/**
 * ProductName
 */
final class ProductDescription
{
    /**
     * @var string
     */
    private string $description;

    /**
     * @param string $description
     */
    public function __construct(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->description;
    }
}