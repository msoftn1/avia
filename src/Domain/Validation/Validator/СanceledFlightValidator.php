<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

/**
 * Валидатор для метода отмены рейса.
 */
class СanceledFlightValidator implements ValidatorInterface
{
    /** @var mixed Идентификатор полета. */
    private $flightId;

    /** @var mixed Секретный ключ. */
    private $secretKey;

    /** @var string Ключ проверки. */
    private string $checkKey;

    /**
     * Конструктор.
     *
     * @param $flightId
     * @param $secretKey
     */
    public function __construct($flightId, $secretKey)
    {
        $this->flightId  = $flightId;
        $this->secretKey = $secretKey;
    }

    /**
     * Установить ключ проверки.
     *
     * @param string $checkKey
     */
    public function setCheckKey($checkKey)
    {
        $this->checkKey = $checkKey;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): ValidatorResult
    {
        $success = true;
        $reason  = '';

        if($this->secretKey !== $this->checkKey) {
            $success = false;
            $reason  = '{secret_key} указан не корректный';
        }
        elseif((int)$this->flightId <= 0) {
            $success = false;
            $reason  = '{flight_id} должно быть числом больше нуля';
        }

        return new ValidatorResult($success, $reason);
    }
}