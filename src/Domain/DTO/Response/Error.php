<?php
namespace App\Domain\DTO\Response;

class Error implements ResponseInterface
{
    private int $status;
    private string $reason;

    /**
     * Error constructor.
     * @param int $status
     * @param string $reason
     */
    public function __construct(int $status, string $reason)
    {
        $this->status = $status;
        $this->reason = $reason;
    }

    public function toArray()
    {
        return [
            'status' => $this->status,
            'reason' => $this->reason
        ];
    }
}