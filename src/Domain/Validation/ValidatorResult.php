<?php
namespace App\Domain\Validation;

class ValidatorResult
{
    private bool $success;
    private string $reason;

    /**
     * ValidatorResult constructor.
     * @param bool $success
     * @param string $reason
     */
    public function __construct(bool $success, string $reason)
    {
        $this->success = $success;
        $this->reason = $reason;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
}