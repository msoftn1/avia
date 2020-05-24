<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

class TicketBuyValidator implements ValidatorInterface
{
    private $number;
    private $flightId;
    private $email;
    private $callbackUrl;

    public function __construct($number, $flightId, $email, $callbackUrl)
    {
        $this->number = $number;
        $this->flightId = $flightId;
        $this->email = $email;
        $this->callbackUrl = $callbackUrl;
    }

    public function validate(): ValidatorResult
    {
        $success = true;
        $reason = '';

        if(!\is_null($this->number) && \mb_strlen($this->number) != 10) {
            $success = false;
            $reason = '{number} должен быть строкой 10 символов';
        }
        elseif((int)$this->flightId <= 0) {
            $success = false;
            $reason = '{flight_id} должно быть числом больше нуля';
        }
        elseif(!\filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $success = false;
            $reason = '{email} должен быть действительным email адресом';
        }
        elseif(!\filter_var($this->callbackUrl, FILTER_VALIDATE_URL)) {
            $success = false;
            $reason = '{callback_url} должен быть корректным URL адресом';
        }

        return new ValidatorResult($success, $reason);
    }
}