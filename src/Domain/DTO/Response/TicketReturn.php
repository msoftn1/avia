<?php


namespace App\Domain\DTO\Response;


class TicketReturn implements ResponseInterface
{
    private int $status;

    /**
     * TicketReturn constructor.
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