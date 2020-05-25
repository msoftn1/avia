<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

/**
 * Валидатор для метода возврата купленного билета.
 */
class TicketReturnValidator implements ValidatorInterface
{
    /** @var mixed Номер билета. */
    private $number;

    /**
     * Конструктор.
     *
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): ValidatorResult
    {
        $success = true;
        $reason  = '';

        if(mb_strlen($this->number) != 10) {
            $success = false;
            $reason  = '{number} должно быть строкой 10 символов';
        }

        return new ValidatorResult($success, $reason);
    }
}