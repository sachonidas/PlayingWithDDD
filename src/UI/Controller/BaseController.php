<?php

namespace Nsign\Auth\UI\Controller;

use DateInterval;
use DateTime;
use League\Tactician\CommandBus;
use Nsign\Auth\UI\Request\BaseRequest;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * BaseController
 */
abstract class BaseController
{
    /**
     * @var CommandBus
     */
    protected CommandBus $commandBus;

    /**
     * @param CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param mixed $data
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function makeResponse(mixed $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse([
            'apiVersion' => getenv('APP_VERSION'),
            'data' => $data,
        ], $code);
    }


    /**
     * @param mixed $data
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function makeResponseWithCookie(mixed $data, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = $this->makeResponse($data, $code);

        $response->headers->setCookie(
            new Cookie(BaseRequest::SESSION_COOKIE_ID, $data['id'], (new DateTime())->add(new DateInterval('P1M')))
        );

        return $response;
    }

    /**
     * @param mixed $data
     * @param int $code
     *
     * @return JsonResponse
     */
    protected function makeResponseWithoutCookie(mixed $data, int $code = Response::HTTP_OK): JsonResponse
    {
        $response = $this->makeResponse($data, $code);

        $response->headers->clearCookie(BaseRequest::SESSION_COOKIE_ID);

        return $response;
    }
    /**
     * @param array $paginator
     * @param $page
     * @param $limit
     *
     * @return JsonResponse
     * @throws Exception
     */
    protected function makePaginatedResponse(mixed $paginator, $page, $limit): JsonResponse
    {
        return $this->makeResponse([
            'currentItemCount' => count($paginator['data']),
            'itemsPerPage' => $limit,
            'pageIndex' => $page,
            'totalItems' => $paginator['count'],
            'totalPages' => ceil($paginator['count'] / $limit),
            'items' => $paginator['data'],
        ]);
    }

}