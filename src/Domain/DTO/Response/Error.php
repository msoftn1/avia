<?php
namespace App\Domain\DTO\Response;

/**
 * DTO результата ошибки.
 */
class Error implements ResponseInterface
{
    /** Статус. */
    private int $status;

    /** Причина. */
    private string $reason;

    /**
     * Конструктор.
     *
     * @param int    $status
     * @param string $reason
     */
    public function __construct(int $status, string $reason)
    {
        $this->status = $status;
        $this->reason = $reason;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'status' => $this->status,
            'reason' => $this->reason
        ];
    }
}