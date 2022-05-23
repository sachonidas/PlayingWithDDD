<?php

namespace Nsign\Auth\Domain\User\ValueObject;

/**
 * ProductName
 */
final class ProductStock
{
    /**
     * @var int
     */
    private int $stock;

    /**
     * @param int $stock
     */
    public function __construct(int $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->stock;
    }
}