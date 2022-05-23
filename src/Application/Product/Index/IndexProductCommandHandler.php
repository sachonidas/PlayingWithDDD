<?php

namespace PlayDDD\Application\Product\Index;

use PlayDDD\Application\Product\BaseProductCommandHandler;

class IndexProductCommandHandler extends BaseProductCommandHandler
{

    public function handle(IndexProductCommand $command): array
    {
        $values = $this->repository->allPagination(
            $command->getPage(),
            $command->getLimit(),
            $command->getSort(),
            $command->getSearch()
        );

        return [
            'count' => 1000,
            'data' => $values
        ];
    }
}