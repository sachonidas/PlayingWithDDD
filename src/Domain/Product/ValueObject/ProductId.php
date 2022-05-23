<?php

namespace Nsign\Auth\Domain\User\ValueObject;

/**
 * ProductId
 */
final class ProductId
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->id;
    }
}