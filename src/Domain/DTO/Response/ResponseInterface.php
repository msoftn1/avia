<?php
namespace App\Domain\DTO\Response;

/**
 * Интерфейс для результирующих DTO.
 */
interface ResponseInterface
{
    /**
     * Представление в виде массива.
     *
     * @return array
     */
    public function toArray();
}