<?php

namespace PlayDDD\Infrastructure\Persistance\Doctrine;

use PlayDDD\Domain\Product\Contract\ProductRepository as ProductRepositoryInterface;
use PlayDDD\Domain\Product\Product;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public static function getEntity(): string
    {
        return Product::class;
    }

    public function all(): array
    {
        return $this->findAll();
    }

    /**
     * @param int $page
     * @param int $limit
     * @param string|null $sort
     * @param string|null $search
     * @return array
     * @throws Exception
     */
    public function allPagination(
        int $page,
        int $limit = 50,
        ?string $sort = 'asc',
        ?string $search = null
    ): array {
        $query = "SELECT p.id, p.name FROM products AS p ".
            ($search ? "WHERE LOWER(p.name) LIKE '%$search%' " : "").
            "ORDER BY p.name $sort ".
            "LIMIT ".(($page - 1) * $limit).",".$limit;

        $query = $this->_em->getConnection()->prepare($query);
        return $query->executeQuery()->fetchAllAssociative();
    }

}