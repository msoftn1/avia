<?php

namespace App\Util;

/**
 * Класс для генерации рандомных значений.
 */
class Random
{
    /**
     * Генерировать рандомную строку.
     *
     * @param int $length
     *
     * @return string
     */
    public static function generateRandomString($length = 10)
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString     = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}