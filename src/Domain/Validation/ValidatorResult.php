<?php
namespace App\Domain\Validation;

/**
 * DTO с результатами валидации.
 */
class ValidatorResult
{
    /** Результат валидации. */
    private bool $success;

    /** Причина ошибки. */
    private string $reason;

    /**
     * Конструктор.
     *
     * @param bool $success
     * @param string $reason
     */
    public function __construct(bool $success, string $reason)
    {
        $this->success = $success;
        $this->reason  = $reason;
    }

    /**
     * Получить результат валидации.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * Получить причину ошибки.
     *
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
}