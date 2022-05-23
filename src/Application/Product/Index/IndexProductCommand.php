<?php

declare(strict_types=1);

namespace PlayDDD\Application\Product\Index;

class IndexProductCommand
{
    /**
     * @var int
     */
    protected int $page;

    /**
     * @var int
     */
    protected int $limit;

    /**
     * @var string|null
     */
    protected ?string $sort;

    /**
     * @var string|null
     */
    protected ?string $search;

    /**
     * @param int $page
     * @param int $limit
     * @param string|null $sort
     * @param string|null $search
     */
    public function __construct(int $page, int $limit, ?string $sort, ?string $search)
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->sort = $sort;
        $this->search = $search;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return string|null
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->search;
    }



}