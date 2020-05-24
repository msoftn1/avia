<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

class AddFlightValidator implements ValidatorInterface
{
    private $name;
    private $flightAt;
    private $secretKey;

    private string $checkKey;

    public function __construct($name, $flightAt, $secretKey)
    {
        $this->name = $name;
        $this->flightAt = $flightAt;
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
        elseif(\mb_strlen($reason) > 255) {
            $success = false;
            $reason = '{name} должен быть строкой до 255 символов';
        }
        elseif((int)$this->flightAt == 0) {
            $success = false;
            $reason = '{flight_at} должно быть числом в формате unix timestamp';
        }

        return new ValidatorResult($success, $reason);
    }
}