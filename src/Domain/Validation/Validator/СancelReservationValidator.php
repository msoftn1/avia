<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

class СancelReservationValidator implements ValidatorInterface
{
    private $number;

    public function __construct($number)
    {
        $this->number = $number;
    }

    public function validate(): ValidatorResult
    {
        $success = true;
        $reason = '';

        if(mb_strlen($this->number) != 10) {
            $success = false;
            $reason = '{number} должно быть строкой 10 символов';
        }

        return new ValidatorResult($success, $reason);
    }
}