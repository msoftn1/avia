<?php
namespace App\Domain\Validation\Validator;

use App\Domain\Validation\ValidatorInterface;
use App\Domain\Validation\ValidatorResult;

/**
 * Валидатор для добавления рейса.
 */
class AddFlightValidator implements ValidatorInterface
{
    /** @param mixed Название рейса. */
    private $name;

    /** @var mixed Время рейса. */
    private $flightAt;

    /** @var mixed Секретный ключ. */
    private $secretKey;

    /** @var string Ключ проверки. */
    private string $checkKey;

    /**
     * Конструктор.
     *
     * @param $name
     * @param $flightAt
     * @param $secretKey
     */
    public function __construct($name, $flightAt, $secretKey)
    {
        $this->name      = $name;
        $this->flightAt  = $flightAt;
        $this->secretKey = $secretKey;
    }

    /**
     * Установить ключ проверки.
     *
     * @param string $checkKey
     */
    public function setCheckKey(string $checkKey)
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
        elseif(\mb_strlen($reason) > 255) {
            $success = false;
            $reason  = '{name} должен быть строкой до 255 символов';
        }
        elseif((int)$this->flightAt == 0) {
            $success = false;
            $reason  = '{flight_at} должно быть числом в формате unix timestamp';
        }

        return new ValidatorResult($success, $reason);
    }
}