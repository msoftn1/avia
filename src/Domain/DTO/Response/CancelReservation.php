<?php


namespace App\Domain\DTO\Response;


class CancelReservation implements ResponseInterface
{
    private int $status;

    /**
     * CancelReservation constructor.
     * @param int $status
     */
    public function __construct(int $status)
    {
        $this->status = $status;
    }

    public function toArray()
    {
        return [
            'status' => $this->status
        ];
    }
}