<?php
namespace App\Domain\Validation;

interface ValidatorInterface
{
    public function validate(): ValidatorResult;
}