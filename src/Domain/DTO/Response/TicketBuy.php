<?php
namespace App\Domain\DTO\Response;

/**
 * DTO результата покупки билета.
 */
class TicketBuy implements ResponseInterface
{
    /** Статус. */
    private int $status;

    /** Номер брони. */
    private string $number;

    /** Место. */
    private int $seat;

    /**
     * Конструктор.
     *
     * @param int    $status
     * @param string $number
     * @param int    $seat
     */
    public function __construct(int $status, string $number, int $seat)
    {
        $this->status = $status;
        $this->number = $number;
        $this->seat   = $seat;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'status' => $this->status,
            'number' => $this->number,
            'seat'   => $this->seat
        ];
    }
}