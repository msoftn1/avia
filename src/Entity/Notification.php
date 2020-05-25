<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity уведомления.
 *
 * @ORM\Table(name="notification", indexes={@ORM\Index(name="notification_event_id_index", columns={"event_id"}), @ORM\Index(name="notification_reservation_id_index", columns={"reservation_id"})})
 * @ORM\Entity
 */
class Notification
{
    /**
     * Идентификатор уведомления.
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * Дата добавления уведомления.
     *
     * @ORM\Column(name="added_at", type="datetime", nullable=false)
     */
    private \DateTimeInterface $addedAt;

    /**
     * Признак обработки уведомления.
     *
     * @ORM\Column(name="is_processed", type="boolean", nullable=false)
     */
    private bool $isProcessed = false;

    /**
     * Дата обработки уведомления.
     *
     * @ORM\Column(name="processed_at", type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $processedAt;

    /**
     * Событие.
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    private Event $event;

    /**
     * Бронирование.
     *
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private Reservation $reservation;

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
     * Получить дату добавления.
     *
     * @return \DateTimeInterface
     */
    public function getAddedAt(): \DateTimeInterface
    {
        return $this->addedAt;
    }

    /**
     * Установить дату добавления.
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
     * Получить признак обработки уведомления.
     *
     * @return bool
     */
    public function getIsProcessed(): bool
    {
        return $this->isProcessed;
    }

    /**
     * Установить признак обработки уведомления.
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
     * Получить дату обработки уведомления.
     *
     * @return \DateTimeInterface|null
     */
    public function getProcessedAt(): ?\DateTimeInterface
    {
        return $this->processedAt;
    }

    /**
     * Установить дату обработки уведомления.
     *
     * @param \DateTimeInterface|null $processedAt
     *
     * @return $this
     */
    public function setProcessedAt(?\DateTimeInterface $processedAt): self
    {
        $this->processedAt = $processedAt;

        return $this;
    }

    /**
     * Получить событие.
     *
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * Установить событие.
     *
     * @param Event $event
     *
     * @return $this
     */
    public function setEvent(Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Получить бронь.
     *
     * @return Reservation
     */
    public function getReservation(): Reservation
    {
        return $this->reservation;
    }

    /**
     * Установить бронь.
     *
     * @param Reservation $reservation
     *
     * @return $this
     */
    public function setReservation(Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }
}
