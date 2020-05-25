<?php
namespace App\Domain\DTO\Response;

/**
 * DTO результата добавления рейса.
 */
class AddFlight implements ResponseInterface
{
    /** Статус. */
    private int $status;

    /** ID рейса. */
    private int $flightId;

    /**
     * Конструктор.
     *
     * @param int $status
     * @param int $flightId
     */
    public function __construct(int $status, int $flightId)
    {
        $this->status   = $status;
        $this->flightId = $flightId;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'status'    => $this->status,
            'flight_id' => $this->flightId
        ];
    }
}