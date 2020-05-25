<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Entity бронирования.
 *
 * @ORM\Table(name="reservation", uniqueConstraints={@ORM\UniqueConstraint(name="reservation_seat_number_unique_index", columns={"number", "seat"})}, indexes={@ORM\Index(name="reservation_flight_id_index", columns={"flight_id"}), @ORM\Index(name="reservation_number_index", columns={"number"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * Идентификатор.
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * Номер брони.
     *
     * @ORM\Column(name="number", type="string", length=10, nullable=false)
     */
    private string $number;

    /**
     * Email.
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private string $email;

    /**
     * Номер места.
     *
     * @ORM\Column(name="seat", type="integer", nullable=false)
     */
    private int $seat;

    /**
     * Дата бронирования.
     *
     * @ORM\Column(name="reservation_at", type="datetime", nullable=false)
     */
    private \DateTimeInterface $reservationAt;

    /**
     * Признак отмены брони.
     *
     * @ORM\Column(name="is_canceled", type="boolean", nullable=false)
     */
    private bool $isCanceled = false;

    /**
     * Дата отмены брони.
     *
     * @ORM\Column(name="cancellation_at", type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $cancellationAt;

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
     * Покупки по брони.
     *
     * @ORM\OneToMany(targetEntity="Purchase", mappedBy="reservation")
     */
    private PersistentCollection $purchases;

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
     * Получить номер брони.
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Установить номер брони.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Получить email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Установить email.
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Получить номер места.
     *
     * @return int
     */
    public function getSeat(): int
    {
        return $this->seat;
    }

    /**
     * Установить номер места.
     *
     * @param int $seat
     *
     * @return $this
     */
    public function setSeat(int $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    /**
     * Получить дату бронирования.
     *
     * @return \DateTimeInterface
     */
    public function getReservationAt(): \DateTimeInterface
    {
        return $this->reservationAt;
    }

    /**
     * Установить дату бронирования.
     *
     * @param \DateTimeInterface $reservationAt
     *
     * @return $this
     */
    public function setReservationAt(\DateTimeInterface $reservationAt): self
    {
        $this->reservationAt = $reservationAt;

        return $this;
    }

    /**
     * Получить признак отмены брони.
     *
     * @return bool|null
     */
    public function getIsCanceled(): bool
    {
        return $this->isCanceled;
    }

    /**
     * Установить признак отмены брони.
     *
     * @param bool $isCanceled
     *
     * @return $this
     */
    public function setIsCanceled(bool $isCanceled): self
    {
        $this->isCanceled = $isCanceled;

        return $this;
    }

    /**
     * Получить дату отмены брони.
     *
     * @return \DateTimeInterface|null
     */
    public function getCancellationAt(): ?\DateTimeInterface
    {
        return $this->cancellationAt;
    }

    /**
     * Установить дату отмены брони.
     *
     * @param \DateTimeInterface|null $cancellationAt
     *
     * @return $this
     */
    public function setCancellationAt(?\DateTimeInterface $cancellationAt): self
    {
        $this->cancellationAt = $cancellationAt;

        return $this;
    }

    /**
     * Установить рейс.
     *
     * @return Flight
     */
    public function getFlight(): Flight
    {
        return $this->flight;
    }

    /**
     * Получить рейс.
     *
     * @param Flight $flight
     *
     * @return $this
     */
    public function setFlight(Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    /**
     * Получить покупки по брони.
     *
     * @return PersistentCollection
     */
    public function getPurchases(): PersistentCollection
    {
        return $this->purchases;
    }
}
