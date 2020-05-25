<?php
namespace App\Domain\DTO\Response;

/**
 * DTO результата отмены рейса.
 */
class CanceledFlight implements ResponseInterface
{
    /** Статус. */
    private int $status;

    /**
     * Конструктор.
     *
     * @param int $status
     */
    public function __construct(int $status)
    {
        $this->status = $status;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'status' => $this->status
        ];
    }
}