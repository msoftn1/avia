<?php


namespace App\Domain\DTO\Response;


class CanceledFlight implements ResponseInterface
{
    private int $status;

    /**
     * CompletedFlight constructor.
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