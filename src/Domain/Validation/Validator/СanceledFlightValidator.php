<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

class СanceledFlightValidator implements ValidatorInterface
{
    private $flightId;
    private $secretKey;

    private string $checkKey;

    public function __construct($flightId, $secretKey)
    {
        $this->flightId = $flightId;
        $this->secretKey = $secretKey;
    }

    public function setCheckKey($checkKey)
    {
        $this->checkKey = $checkKey;
    }

    public function validate(): ValidatorResult
    {
        $success = true;
        $reason = '';

        if($this->secretKey !== $this->checkKey) {
            $success = false;
            $reason = '{secret_key} указан не корректный';
        }
        elseif((int)$this->flightId <= 0) {
            $success = false;
            $reason = '{flight_id} должно быть числом больше нуля';
        }

        return new ValidatorResult($success, $reason);
    }
}