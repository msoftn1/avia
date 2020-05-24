<?php


namespace App\Domain\DTO\Response;


class AddFlight implements ResponseInterface
{
    private int $status;
    private int $flightId;

    /**
     * AddFlight constructor.
     * @param int $status
     * @param int $flightId
     */
    public function __construct(int $status, int $flightId)
    {
        $this->status = $status;
        $this->flightId = $flightId;
    }

    public function toArray()
    {
        return [
            'status' => $this->status,
            'flight_id' => $this->flightId
        ];
    }
}