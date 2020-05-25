<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

/**
 * Валидатор для метода бронирования билета.
 */
class ToBookFlightValidator implements ValidatorInterface
{
    /** @var mixed Номер рейса. */
    private $flightId;

    /** @var mixed Email */
    private $email;

    /**
     * Конструктор.
     *
     * @param $flightId
     * @param $email
     */
    public function __construct($flightId, $email)
    {
        $this->flightId = $flightId;
        $this->email    = $email;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): ValidatorResult
    {
        $success = true;
        $reason  = '';

        if((int)$this->flightId <= 0) {
            $success = false;
            $reason  = '{flight_id} должно быть числом больше нуля';
        }
        elseif(!\filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $success = false;
            $reason  = '{email} должен быть действительным email адресом';
        }

        return new ValidatorResult($success, $reason);
    }
}