<?php

namespace App\Domain\DTO;

/**
 * DTO результата обработки событий.
 */
class ProcessEvents
{
    /** Количество событий. */
    private int $cntEvents;

    /** Количество уведомлений. */
    private int $cntNotification;

    /**
     * Конструктор.
     *
     * @param int $cntEvents
     * @param int $cntNotification
     */
    public function __construct(int $cntEvents, int $cntNotification)
    {
        $this->cntEvents       = $cntEvents;
        $this->cntNotification = $cntNotification;
    }

    /**
     * Количество обработанных событий.
     *
     * @return int
     */
    public function getCntEvents(): int
    {
        return $this->cntEvents;
    }

    /**
     * Количество сгенерированных уведомлений.
     *
     * @return int
     */
    public function getCntNotification(): int
    {
        return $this->cntNotification;
    }
}