<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

/**
 * Валидатор для метода покупки билета на рейс.
 */
class TicketBuyValidator implements ValidatorInterface
{
    /** @var mixed Номер брони. */
    private $number;

    /** @var mixed Номер рейса. */
    private $flightId;

    /** @var mixed Email */
    private $email;

    /**
     * Конструктор.
     *
     * @param $number
     * @param $flightId
     * @param $email
     */
    public function __construct($number, $flightId, $email)
    {
        $this->number   = $number;
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

        if(!\is_null($this->number) && \mb_strlen($this->number) != 10) {
            $success = false;
            $reason  = '{number} должен быть строкой 10 символов';
        }
        elseif((int)$this->flightId <= 0) {
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