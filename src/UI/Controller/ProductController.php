<?php

namespace PlayDDD\UI\Controller;

use Nsign\Auth\UI\Controller\BaseController;
use Nsign\Translation\Application\Project\Index\IndexProductRequest;
use PlayDDD\Application\Product\Index\IndexProductCommand;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseController
{
    public function getIndex(IndexProductRequest $request): Response
    {
        $result = $this->commandBus->handle(
            new IndexProductCommand(
                $request->getPage(),
                $request->getLimit(),
                $request->getSort(),
                $request->getSearch()
            )
        );

        return $this->makePaginatedResponse($result, $request->getPage(), $request->getLimit());
    }

}