<?php
namespace App\Domain\Validation;

/**
 * Интерфейс для валидации данных в API.
 */
interface ValidatorInterface
{
    /**
     * Валидировать.
     *
     * @return ValidatorResult
     */
    public function validate(): ValidatorResult;
}