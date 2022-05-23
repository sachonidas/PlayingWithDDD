<?php

namespace Nsign\Auth\Domain\User\ValueObject;

/**
 * ProductName
 */
final class ProductPrice
{
    /**
     * @var float
     */
    private float $price;

    /**
     * @param float $price
     */
    public function __construct(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->price;
    }
}