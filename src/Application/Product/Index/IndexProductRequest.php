<?php

declare(strict_types=1);

namespace Nsign\Translation\Application\Project\Index;

use Nsign\Translation\UI\Request\BaseRequest;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IndexProductRequestBaseRequest.php.
 */
class IndexProductRequest extends BaseRequest
{
    /**
     * @return Assert\Collection
     */
    public function getRules(): Assert\Collection
    {
        return new Assert\Collection([
            'page' => [
                new Assert\Optional([
                    new Assert\Type('numeric'),
                ]),
            ],
            'limit' => [
                new Assert\Optional([
                    new Assert\Type('numeric'),
                ]),
            ],
            'q' => [
                new Assert\Optional([
                    new Assert\Type('string'),
                ]),
            ],
            'sort' => [
                new Assert\Optional([
                    new Assert\Type('string'),
                    new Assert\Choice([
                        'asc',
                        'desc',
                    ]),
                ]),
            ],
        ]);
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return (int)$this->get('page') ?: 1;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return (int)$this->get('limit') ?: 50;
    }

    /**
     * @return string|null
     */
    public function getSort(): ?string
    {
        return $this->get('sort');
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->get('q');
    }
}
