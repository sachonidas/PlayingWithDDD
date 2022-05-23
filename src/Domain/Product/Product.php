<?php

namespace PlayDDD\Domain\Product;
use Nsign\Auth\Domain\User\ValueObject\ProductDescription;
use Nsign\Auth\Domain\User\ValueObject\ProductId;
use Nsign\Auth\Domain\User\ValueObject\ProductName;
use Nsign\Auth\Domain\User\ValueObject\ProductPrice;
use Nsign\Auth\Domain\User\ValueObject\ProductStock;

/**
 */
class Product
{

    /**
     * @var ProductId
     */
    protected ProductId $id;

    /**
     * @var ProductName
     */
    protected ProductName $name;

    /**
     * @var ProductDescription
     */
    protected ProductDescription $description;

    /**
     * @var ProductPrice
     */
    protected ProductPrice $price;

    /**
     * @var ProductStock
     */
    protected ProductStock $stock;

    /**
     * @return ProductId
     */
    public function getId(): ProductId
    {
        return $this->id;
    }

    /**
     * @return ProductName
     */
    public function getName(): ProductName
    {
        return $this->name;
    }

    /**
     * @return ProductDescription
     */
    public function getDescription(): ProductDescription
    {
        return $this->description;
    }

    /**
     * @return ProductPrice
     */
    public function getPrice(): ProductPrice
    {
        return $this->price;
    }

    /**
     * @return ProductStock
     */
    public function getStock(): ProductStock
    {
        return $this->stock;
    }



    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId()->value(),
            'name' => $this->getName()->value(),
            'price' => $this->getPrice()->value(),
            'description' => $this->getDescription()->value(),
            'stock' => $this->getStock()->value(),
        ];

    }

}