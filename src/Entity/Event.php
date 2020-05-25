<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity событий рейсов.
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="event_flight_id", columns={"flight_id"})})
 * @ORM\Entity
 */
class Event
{
    /** Продажа билетов нарейс завершена. */
    const EVENT_TYPE_COMPLETED = 1;

    /** Рейс отменен. */
    const EVENT_TYPE_CANCELED = 2;

    /**
     * Идентификатор.
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * Дата добавления события.
     *
     * @ORM\Column(name="added_at", type="datetime", nullable=false)
     */
    private \DateTimeInterface $addedAt;

    /**
     * Тип события.
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private int $type;

    /**
     * Событие обработано.
     *
     * @ORM\Column(name="is_processed", type="boolean", nullable=false)
     */
    private bool $isProcessed = false;

    /**
     * Рейс.
     *
     * @ORM\ManyToOne(targetEntity="Flight")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="flight_id", referencedColumnName="id")
     * })
     */
    private Flight $flight;

    /**
     * Получить идентификатор.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Получить дату добавления события.
     *
     * @return \DateTimeInterface
     */
    public function getAddedAt(): \DateTimeInterface
    {
        return $this->addedAt;
    }

    /**
     * Установить дату добавления события.
     *
     * @param \DateTimeInterface $addedAt
     *
     * @return $this
     */
    public function setAddedAt(\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    /**
     * Получить тип события.
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Установить тип события.
     *
     * @param int $type
     *
     * @return $this
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Получить признак обработки события.
     *
     * @return bool
     */
    public function getIsProcessed(): bool
    {
        return $this->isProcessed;
    }

    /**
     * Установить признак обработки события.
     *
     * @param bool $isProcessed
     *
     * @return $this
     */
    public function setIsProcessed(bool $isProcessed): self
    {
        $this->isProcessed = $isProcessed;

        return $this;
    }

    /**
     * Получить рейс.
     *
     * @return Flight
     */
    public function getFlight(): Flight
    {
        return $this->flight;
    }

    /**
     * Установить рейс.
     *
     * @param Flight|null $flight
     *
     * @return $this
     */
    public function setFlight(Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }
}
