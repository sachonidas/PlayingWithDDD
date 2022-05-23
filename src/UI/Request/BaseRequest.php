<?php

declare(strict_types=1);

namespace Nsign\Translation\UI\Request;

use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Nsign\Translation\Infrastructure\Exception\TranslationException;
use Nsign\Translation\Infrastructure\Exception\BaseException;
use Nsign\Translation\Infrastructure\Exception\RequestValidationException;
use Nsign\Translation\Infrastructure\Security\AuthSecurity;
use Nsign\Translation\UI\Request\DTO\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class BaseRequest.
 */
abstract class BaseRequest extends Request
{
    /**
     * @var RequestDTO $requestDTO
     */
    protected RequestDTO $requestDTO;

    /**
     * Validate the class instance.
     *
     * @param ValidatorInterface $validator
     *
     * @throws TranslationException
     * @throws RequestValidationException
     */
    public function validate(ValidatorInterface $validator): void
    {
        /* General method to modify values before validation (Can be overridden) */
        $this->prepareValidation();
        /* Auth Phase */
        if (!$this->passesAuthorization()) {
            $this->failedAuthorization();
        }
        /* Validation Phase */
        $violations = $this->processValidation($validator);
        if (!$this->passesValidation($violations)) {
            $this->failedValidation($violations);
        }
        /* General method to modify values after validation (Can be overridden) */
        $this->afterValidation($validator);
    }

    /**
     * @param AuthSecurity $service
     * @return void
     * @throws JWTDecodeFailureException
     */
    public function buildDTO(AuthSecurity $service): void
    {
//        $data = $service->getPayloadFromToken();
//        $this->requestDTO = new RequestDTO($data);
    }

    /**
     * @return RequestDTO
     */
    public function getDTO(): RequestDTO
    {
        return $this->requestDTO;
    }

    /**
     * @return array
     */
    public function getAllParams(): array
    {
        return array_merge($this->request->all(), $this->query->all());
    }

    /**
     * @return array
     */
    private function getRawContent(): array
    {
        return ($raw = $this->getContent()) ? json_decode($raw, true) : [];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareValidation(): void
    {
        /* Merge raw body into the request object */
        if ($raw = $this->getRawContent()) {
            $this->request->add($raw);
        }
    }

    /**
     * Set the data after validation.
     */
    protected function afterValidation(ValidatorInterface $validator): void
    {
    }

    /**
     * Check for authorization fail.
     *
     * @return bool
     */
    protected function passesAuthorization(): bool
    {
        return 'json' === $this->getContentType();
    }

    /**
     * @return void
     * @throws TranslationException
     */
    protected function failedAuthorization(): void
    {
        throw new TranslationException(BaseException::GENERAL_415_ERROR, 415);
    }

    /**
     * Process validation.
     *
     * @param ValidatorInterface $validator
     *
     * @return ConstraintViolationListInterface
     */
    protected function processValidation(ValidatorInterface $validator): ConstraintViolationListInterface
    {
        return $validator->validate($this->getAllParams(), $this->getRules());
    }

    /**
     * Check for validation fail.
     *
     * @param ConstraintViolationListInterface $violations
     *
     * @return bool
     */
    protected function passesValidation(ConstraintViolationListInterface $violations): bool
    {
        return 0 == $violations->count();
    }

    /**
     * Behaviour if the Request validation fails.
     *
     * @param ConstraintViolationListInterface $violations
     *
     * @throws RequestValidationException
     */
    protected function failedValidation(ConstraintViolationListInterface $violations): void
    {
        /* 422 Error -> Unprocessable entity */
        throw new RequestValidationException($violations);
    }

    /**
     * Set custom rules for request.
     *
     * @return Constraint|array
     */
    public function getRules(): Constraint|array
    {
        return [];
    }
}
