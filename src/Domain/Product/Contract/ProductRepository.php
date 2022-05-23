<?php

namespace PlayDDD\Domain\Product\Contract;

interface ProductRepository
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param int $page
     * @param int $limit
     * @param string|null $sort
     * @param string|null $search
     * @return mixed
     */
    public function allPagination(int $page, int $limit, ?string $sort, ?string $search): mixed;

}