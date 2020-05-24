<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="reservation_flight_id_index", columns={"flight_id"}), @ORM\Index(name="reservation_number_index", columns={"number"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="seat", type="integer", nullable=false)
     */
    private $seat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reservation_at", type="datetime", nullable=false)
     */
    private $reservationAt;

    /**
     * @var string
     *
     * @ORM\Column(name="callback_url", type="string", length=255, nullable=false)
     */
    private $callbackUrl;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_canceled", type="boolean", nullable=false)
     */
    private $isCanceled = false;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cancellation_at", type="datetime", nullable=true)
     */
    private $cancellationAt;

    /**
     * @var \Flight
     *
     * @ORM\ManyToOne(targetEntity="Flight")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="flight_id", referencedColumnName="id")
     * })
     */
    private $flight;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSeat(): ?int
    {
        return $this->seat;
    }

    public function setSeat(int $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getReservationAt(): ?\DateTimeInterface
    {
        return $this->reservationAt;
    }

    public function setReservationAt(\DateTimeInterface $reservationAt): self
    {
        $this->reservationAt = $reservationAt;

        return $this;
    }

    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl(string $callbackUrl): self
    {
        $this->callbackUrl = $callbackUrl;

        return $this;
    }

    public function getIsCanceled(): ?bool
    {
        return $this->isCanceled;
    }

    public function setIsCanceled(bool $isCanceled): self
    {
        $this->isCanceled = $isCanceled;

        return $this;
    }

    public function getCancellationAt(): ?\DateTimeInterface
    {
        return $this->cancellationAt;
    }

    public function setCancellationAt(?\DateTimeInterface $cancellationAt): self
    {
        $this->cancellationAt = $cancellationAt;

        return $this;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }


}
