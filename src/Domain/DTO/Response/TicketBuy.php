<?php


namespace App\Domain\DTO\Response;


class TicketBuy implements ResponseInterface
{
    private int $status;
    private string $number;
    private int $seat;

    /**
     * ToBookFlight constructor.
     * @param int $status
     */
    public function __construct(int $status, string $number, int $seat)
    {
        $this->status = $status;
        $this->number = $number;
        $this->seat = $seat;
    }

    public function toArray()
    {
        return [
            'status' => $this->status,
            'number' => $this->number,
            'seat' => $this->seat
        ];
    }
}